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
            $this->user = new User(['role' => Role::CompanyUser]);
            $this->userCompanyAccess = new UserCompanyAccess(['role' => Role::Administrator]);
        }
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

            if ($this->contact->isDirty()) {
                $this->contact->company()->associate($this->company);
                $this->contact->save();
            }

            if ($this->companyIdentity->isDirty()) {
                $this->companyIdentity->company()->associate($this->company);
                $this->companyIdentity->save();
            }

            if ($this->clientAnalysis->isDirty()) {
                $this->companyIdentity->company()->associate($this->company);
                $this->companyIdentity->save();
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
        } catch (Throwable $exception) {
            $this->exceptionAlert($exception);
        }
    }

    public function saveContact()
    {
    }

    public function saveIdentity()
    {
    }

    public function saveCredit()
    {
    }

    public function saveBankInformation()
    {
    }

    public function saveUser()
    {
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
            ! $this->client->exists ? CompanyUserForm::getValidationRules($this->user) : [],
        );
    }

    public function getModel()
    {
        return $this->client ?? null;
    }
}
