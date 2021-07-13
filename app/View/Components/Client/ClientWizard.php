<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Client;

use App\Enums\Role;
use App\Models\Address;
use App\Models\BankInformation;
use App\Models\Client;
use App\Models\ClientAnalysis;
use App\Models\ClientFundingInstructions;
use App\Models\Company;
use App\Models\CompanyIdentity;
use App\Models\ContactDetails;
use App\Models\User;
use App\Models\UserCompanyAccess;
use App\View\Components\Component;
use App\View\Components\Traits\ConfirmModelDelete;
use App\View\Components\Traits\WithNested;
use DB;
use Throwable;

class ClientWizard extends Component
{
    use ConfirmModelDelete;
    use WithNested;

    public Client $client;
    public ClientAnalysis $clientAnalysis;
    public Company $company;
    public CompanyIdentity $companyIdentity;
    public Address $address;
    public ContactDetails $contact;
    public BankInformation $bankInformation;
    public ClientFundingInstructions $fundingInstructions;
    public ?User $user;
    public ?UserCompanyAccess $userCompanyAccess;

    public function mount($client_id = null)
    {
        $this->client = Client::with([
            'company',
            'company.identity',
            'company.address',
            'company.contactDetails',
            'company.bankInformation',
            'analysis',
        ])->findOrNew($client_id);

        $this->company = $this->client->company ?? new Company();
        $this->companyIdentity = $this->company->identity ?? new CompanyIdentity();
        $this->clientAnalysis = $this->client->analysis ?? new ClientAnalysis();
        $this->address = $this->company->address ?? new Address();
        $this->contact = $this->company->contactDetails ?? new ContactDetails();
        $this->bankInformation = $this->company->bankInformation ?? new BankInformation();
        $this->fundingInstructions = $this->client->fundingInstructions ?? new ClientFundingInstructions();

        $this->user = new User();
        $this->userCompanyAccess = new UserCompanyAccess();
    }

    public function saveClient()
    {
        $this->validate();

        // TODO @Jovana: should be separate service + reusable middlewares

        try {
            DB::beginTransaction();

            $this->company->save();

            $this->client->company()->associate($this->company);
            $this->client->save();

            if ($this->fundingInstructions->isDirty()) {
                $this->fundingInstructions->client()->associate($this->client);
                $this->fundingInstructions->save();
            }

            DB::commit();

            $this->successAlert();
        } catch (Throwable $exception) {
            DB::rollBack();
            $this->exceptionAlert($exception);
        }
    }

    public function saveContact()
    {
        $this->validate();
        try {
            DB::beginTransaction();

            $this->address->company()->associate($this->company);
            $this->address->save();

            $this->bankInformation->company()->associate($this->company);
            $this->bankInformation->save();

            DB::commit();

            $this->successAlert();
        } catch (Throwable $exception) {
            DB::rollBack();
            $this->exceptionAlert($exception);
        }
    }

    public function saveIdentity()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $this->companyIdentity->company()->associate($this->company);
            $this->companyIdentity->save();

            $this->companyIdentity->company()->associate($this->company);
            $this->companyIdentity->save();

            DB::commit();

            $this->successAlert();
        } catch (Throwable $exception) {
            DB::rollBack();
            $this->exceptionAlert($exception);
        }
    }

    public function saveCredit()
    {
    }

    public function saveBankInformation()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $this->bankInformation->company()->associate($this->company);
            $this->bankInformation->save();

            DB::commit();

            $this->successAlert();
        } catch (Throwable $exception) {
            DB::rollBack();
            $this->exceptionAlert($exception);
        }
    }

    public function saveUser()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            if (! $this->client->exists) {
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

            $this->successAlert();
        } catch (Throwable $exception) {
            DB::rollBack();
            $this->exceptionAlert($exception);
        }
    }

    public function render()
    {
        return view('client.wizard');
    }

    public function getRules()
    {
        /*
         * Email uniqueness should not be validated
         * If user with given email address exists - company access is granted for that user
         * Email address update is not allowed
         */

        $userRules = $this->user->getRules(false);
        $userRules['user.email'] = ['string', 'email', 'min:8', 'max:255'];

        return array_merge(
            $this->client->getRules(),
            $this->company->getRules(),
            $this->companyIdentity->getRules(false),
            $this->clientAnalysis->getRules(false),
            $this->bankInformation->getRules(false),
            $this->address->getRules(false),
            $this->contact->getRules(false),
            $this->fundingInstructions->getRules(false),
            $this->userCompanyAccess->getRules(false),
            $userRules
        );
    }
}
