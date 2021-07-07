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
use App\Models\Company;
use App\Models\CompanyIdentity;
use App\Models\ContactDetails;
use App\Models\Factor;
use App\Models\User;
use App\Models\UserCompanyAccess;
use App\View\Components\Address\AddressForm;
use App\View\Components\BankInformation\BankInformationForm;
use App\View\Components\Company\CompanyForm;
use App\View\Components\Company\CompanyIdentityForm;
use App\View\Components\Company\User\CompanyUserForm;
use App\View\Components\Contact\ContactForm;
use App\View\Components\Traits\ConfirmModelDelete;
use DB;
use Livewire\Component;
use Log;
use Throwable;

class ClientWizard extends Component
{
    use ConfirmModelDelete;

    public Client $client;
    public ClientAnalysis $clientAnalysis;
    public Factor $factor;
    public Company $company;
    public CompanyIdentity $companyIdentity;
    public Address $address;
    public ContactDetails $contact;
    public BankInformation $bankInformation;
    public ?User $user;
    public ?UserCompanyAccess $userCompanyAccess;

    public function mount($id = null)
    {
        $this->client = Client::with([
            'company',
            'company.identity',
            'company.address',
            'company.contactDetails',
            'company.bankInformation',
            'analysis',
        ])->findOrNew($id);

        $this->company = $this->client->company ?? new Company();
        $this->companyIdentity = $this->company->identity ?? new CompanyIdentity();
        $this->clientAnalysis = $this->client->analysis ?? new ClientAnalysis();
        $this->address = $this->company->address ?? new Address();
        $this->contact = $this->company->contactDetails ?? new ContactDetails();
        $this->bankInformation = $this->company->bankInformation ?? new BankInformation();

        if (! $this->client->exists) {
            $this->user = new User();
            $this->userCompanyAccess = new UserCompanyAccess();
        }
    }

    /* Realtime validation */

    public function updated($property)
    {
        $this->validateOnly($property);
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

            if (isset($this->user) && isset($this->userCompanyAccess)) {
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
        return array_merge(
            ClientForm::getValidationRules(),
            ClientFactorForm::getValidationRules(),
            CompanyIdentityForm::getValidationRules($this->companyIdentity),
            ClientAnalysisForm::getValidationRules($this->clientAnalysis),
            CompanyForm::getValidationRules($this->company),
            BankInformationForm::getValidationRules($this->bankInformation),
            AddressForm::getValidationRules($this->address),
            ContactForm::getValidationRules(),
            isset($this->user, $this->userCompanyAccess) && ($this->user->isDirty() || $this->userCompanyAccess->isDirty()) ? CompanyUserForm::getValidationRules() : [],
        );
    }
}
