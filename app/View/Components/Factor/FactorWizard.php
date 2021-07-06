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
use App\View\Components\Address\AddressForm;
use App\View\Components\BankInformation\BankInformationForm;
use App\View\Components\Company\CompanyForm;
use App\View\Components\Contact\ContactForm;
use App\View\Components\Traits\ConfirmModelDelete;
use App\View\Components\UserCompanyAccess\UserCompanyAccessForm;
use DB;
use Illuminate\Validation\Rule;
use Livewire\Component;

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

    public function mount($id = null)
    {
        $this->factor = Factor::with([
            'company',
            'company.address',
            'company.contactDetails',
            'company.bankInformation',
            'subscriptionPlan',
        ])->findOrNew($id);

        $this->company = $this->factor->company ?? new Company();
        $this->address = $this->company->address ?? new Address();
        $this->contact = $this->company->contactDetails ?? new ContactDetails();
        $this->bankInformation = $this->company->bankInformation ?? new BankInformation();

        if (! $this->factor->exists) {
            $this->user = new User(['role' => Role::CompanyUser]);
            $this->userCompanyAccess = new UserCompanyAccess(['role' => Role::Administrator]);
        }
    }

    public function save()
    {
        $this->validate();

        // TODO: should be separate service + reusable middlewares

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

        if (isset($this->user) && isset($this->userCompanyAccess)) {
            $this->user->save();

            $this->userCompanyAccess->user()->associate($this->user);
            $this->userCompanyAccess->company()->associate($this->company);

            $this->userCompanyAccess->save();
        }

        DB::commit();

        $this->emit('saved');
    }

    public function render()
    {
        return view('factor.wizard');
    }

    public function getRules()
    {
        return array_merge(
            FactorForm::getValidationRules(),
            SubscriptionPlanForm::getValidationRules(),
            CompanyForm::getValidationRules($this->company),
            BankInformationForm::getValidationRules($this->bankInformation),
            AddressForm::getValidationRules($this->address),
            ContactForm::getValidationRules(),
            [
                'user.email' => [Rule::requiredIf(! $this->factor->exists), 'string', 'email', 'min:8', 'max:255', 'unique:users,email'],
                'user.role' => [Rule::requiredIf(! $this->factor->exists), 'int'],
            ],
            ! $this->factor->exists ? UserCompanyAccessForm::getValidationRules() : [],
        );
    }

    public function getModel()
    {
        return $this->factor ?? null;
    }
}
