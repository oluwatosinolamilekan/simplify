<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Factor;

use App\Enums\Role;
use App\Models\Address;
use App\Models\BankInformation;
use App\Models\Company;
use App\Models\ContactDetails;
use App\Models\Factor;
use App\Models\User;
use App\Models\UserCompanyAccess;
use App\View\Components\Component;
use App\View\Components\Traits\ConfirmModelDelete;
use DB;
use Throwable;

class FactorWizard extends Component
{
    use ConfirmModelDelete;

    public Factor $factor;
    public Company $company;
    public Address $address;
    public ContactDetails $contact;
    public BankInformation $bankInformation;
    public ?User $user;
    public ?UserCompanyAccess $userCompanyAccess;

    public function mount($factor_id = null)
    {
        $this->factor = Factor::with([
            'company',
            'company.address',
            'company.contactDetails',
            'company.bankInformation',
            'subscriptionPlan',
        ])->findOrNew($factor_id);

        $this->company = $this->factor->company ?? new Company();
        $this->address = $this->company->address ?? new Address();
        $this->contact = $this->company->contactDetails ?? new ContactDetails();
        $this->bankInformation = $this->company->bankInformation ?? new BankInformation();

        $this->user = new User(['role' => Role::CompanyUser]);
        $this->userCompanyAccess = new UserCompanyAccess(['role' => Role::Administrator]);
    }

    public function save()
    {
        $this->validate();

        // TODO @Jovana: should be separate service + reusable middlewares

        try {
            DB::beginTransaction();

            $this->company->save();

            $this->factor->company()->associate($this->company);
            $this->factor->save();

            if ($this->contact->isDirty()) {
                $this->contact->company()->associate($this->company);
                $this->contact->save();
            }

            if ($this->address->isDirty()) {
                $this->address->company()->associate($this->company);
                $this->address->save();
            }

            if ($this->bankInformation->isDirty()) {
                $this->bankInformation->company()->associate($this->company);
                $this->bankInformation->save();
            }

            if (! $this->factor->exists) {
                /* If user is fresh new record ("create" scenario) - try to find user with given email first */
                if (! $this->user->exists) {
                    $this->user = User::firstOrNew(['email' => $this->user->email], ['role' => Role::CompanyUser]);
                }

                $this->user->save();

                $this->userCompanyAccess->user()->associate($this->user);
                $this->userCompanyAccess->company()->associate($this->company);

                $this->userCompanyAccess->save();
            }

            DB::commit();

            $this->emit('saved');
        } catch (Throwable $exception) {
            $this->exceptionAlert($exception);
        }
    }

    public function render()
    {
        return view('factor.wizard');
    }

    public function getRules()
    {
        /*
         * Email uniqueness should not be validated
         * If user with given email address exists - company access is granted for that user
         * Email address update is not allowed
         */

        $userRules = $this->user->getRules(! $this->factor->exists);
        $userRules['user.email'] = ['required', 'string', 'email', 'min:8', 'max:255'];

        return array_merge(
            $this->factor->getRules(),
            $this->company->getRules(),
            $this->bankInformation->getRules(false),
            $this->address->getRules(false),
            $this->contact->getRules(false),
            $this->userCompanyAccess->getRules(! $this->factor->exists),
            $userRules
        );
    }

    public function getModel()
    {
        return $this->factor ?? null;
    }
}
