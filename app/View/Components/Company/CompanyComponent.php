<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Company;

use App\Enums\Role;
use App\Models\Address;
use App\Models\BankInformation;
use App\Models\Company;
use App\Models\CompanyIdentity;
use App\Models\ContactDetails;
use App\Models\User;
use App\Models\UserCompanyAccess;
use App\Support\Validation\ValidationRules;
use App\View\Components\Component;
use Illuminate\Database\Eloquent\Collection;

class CompanyComponent extends Component
{
    public Company $company;
    public Address $address;
    public ContactDetails $contact;
    public Collection $bankInformation;
    public CompanyIdentity $companyIdentity;
    public ?User $user;
    public ?UserCompanyAccess $userCompanyAccess;

    public function mount($company_id)
    {
        $this->company = Company::with([
            'identity',
            'address',
            'contactDetails',
            'bankInformation',
        ])->findOrNew($company_id);

        $this->companyIdentity = $this->company->identity ?? new CompanyIdentity();
        $this->address = $this->company->address ?? new Address();
        $this->contact = $this->company->contactDetails ?? new ContactDetails();
        $this->bankInformation = $this->company->bankInformation ?? new BankInformation();

        $this->user = new User(['role' => Role::CompanyUser]);
        $this->userCompanyAccess = new UserCompanyAccess(['role' => Role::Administrator]);
    }

    public function saveAddressInformation()
    {
        if ($this->address->isDirty()) {
            $this->company->address()->save($this->address);
        }
    }

    public function saveBankInformation()
    {
        if ($this->bankInformation->isDirty()) {
            $this->company->bankInformation()->save($this->bankInformation);
        }
    }

    public function saveCompanyIdentity()
    {
        if ($this->companyIdentity->isDirty()) {
            $this->company->identity()->save($this->companyIdentity);
        }
    }

    public function saveContactDetails()
    {
        if ($this->contact->isDirty()) {
            $this->company->contactDetails()->save($this->contact);
        }
    }

    public function saveUser()
    {
        /* If user is fresh new record ("create" scenario) - try to find user with given email first */
        if (! $this->user->exists) {
            $this->user = User::firstOrNew(['email' => $this->user->email], ['role' => Role::CompanyUser]);
        }

        $this->user->save();

        $this->userCompanyAccess->user()->associate($this->user);
        $this->userCompanyAccess->company()->associate($this->company);

        $this->userCompanyAccess->save();
    }

    public function getRules()
    {
        /*
         * Email uniqueness should not be validated
         * If user with given email address exists - company access is granted for that user
         * Email address update is not allowed
         */

        $userRules = $this->user->getRules(false);
        $userRules['user.email'] = ['required', 'string', 'email', 'min:8', 'max:255'];

        return ValidationRules::merge(
            ValidationRules::forModel('company', $this->company, true),
            ValidationRules::forModel('companyIdentity', $this->companyIdentity, false),
            ValidationRules::forModel('userCompanyAccess', $this->userCompanyAccess, false),
            ValidationRules::forProperty('user', $userRules)
        );
    }
}
