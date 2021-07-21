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
use App\View\Components\Traits\WithNested;
use Exception;

/**
 * Class CompanyComponent.
 */
class CompanyComponent extends Component
{
    use WithNested;

    public Company $company;
    public Address $address;
    public ContactDetails $contact;
    public BankInformation $bankInformation;
    public CompanyIdentity $identity;
    public ?User $user;
    public ?UserCompanyAccess $userCompanyAccess;

    /**
     * @param Company $company
     * @throws Exception
     */
    public function mount(Company $company)
    {
        $this->company = $company;
        $this->company->load(['identity', 'address', 'contactDetails', 'bankInformation']);

        $this->initRelated();
    }

    /**
     * @throws Exception
     */
    public function initRelated()
    {
        $this->identity = $this->company->getRelatedInstanceOrNew('identity');
        $this->address = $this->company->getRelatedInstanceOrNew('address');
        $this->contact = $this->company->getRelatedInstanceOrNew('contactDetails');
        $this->bankInformation = $this->company->getRelatedInstanceOrNew('bankInformation');

        $this->user = new User();
        $this->userCompanyAccess = new UserCompanyAccess(['role' => Role::Administrator]);
    }

    /**
     * Saved hook for userCompanyAccess model
     * Refreshes users list and user and userCompanyAccess models.
     */
    public function savedUserCompanyAccess()
    {
        $this->emit('refreshLivewireDatatable');

        $this->user = new User();
        $this->userCompanyAccess = new UserCompanyAccess(['role' => Role::Administrator]);
    }

    /**
     * @return array
     */
    public function getRules()
    {
        /*
         * Email uniqueness should not be validated
         * If user with given email address exists - company access is granted for that user
         * Email address update is not allowed
         */

        $userRules = $this->user->getRules(false);
        $userRules['email'] = ['required', 'string', 'email', 'min:8', 'max:255'];

        return ValidationRules::merge(
            ValidationRules::forModel('company', $this->company, true),
            ValidationRules::forModel('identity', $this->identity, false),
            ValidationRules::forModel('userCompanyAccess', $this->userCompanyAccess, false),
            ValidationRules::forModel('bankInformation', $this->bankInformation, false),
            ValidationRules::forModel('address', $this->address, false),
            ValidationRules::forModel('contact', $this->contact, false),
            ValidationRules::forProperty('user', $userRules)
        );
    }
}
