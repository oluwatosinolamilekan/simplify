<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Factor;

use App\Models\Address;
use App\Models\BankInformation;
use App\Models\Company;
use App\Models\ContactDetails;
use App\Models\Factor;
use App\View\Components\Traits\ConfirmModelDelete;
use Livewire\Component;

class FactorDetails extends Component
{
    use ConfirmModelDelete;

    public Factor $factor;
    public Company $company;
    public Address $address;
    public ContactDetails $contact;
    public BankInformation $bankInformation;

    public function mount($factor_id)
    {
        $this->factor = Factor::with(['company', 'company.address', 'company.contactDetails', 'company.bankInformation', 'subscriptionPlan'])->findOrFail($factor_id);

        $this->company = $this->factor->company ?? new Company();
        $this->address = $this->company->address ?? new Address();
        $this->contact = $this->company->contactDetails ?? new ContactDetails();
        $this->bankInformation = $this->company->bankInformation ?? new BankInformation();
    }

    public function render()
    {
        return view('factor.details');
    }

    public function saveAddressInformation()
    {
        $this->validate();
        $this->company->address()->save($this->address);
    }

    public function saveBankInformation()
    {
        $this->validate();
        $this->company->bankInformation()->save($this->bankInformation);
    }

    public function getRules()
    {
        return array_merge(
            $this->bankInformation->getRules(false),
            $this->address->getRules(false)
        );
    }
}
