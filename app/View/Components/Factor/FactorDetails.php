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
use App\View\Components\Company\CompanyComponent;
use App\View\Components\Traits\ConfirmModelDelete;

class FactorDetails extends CompanyComponent
{
    use ConfirmModelDelete;

    public Factor $factor;
    public Company $company;
    public Address $address;
    public ContactDetails $contact;
    public BankInformation $bankInformation;

    public function mount($factor_id)
    {
        $this->factor = Factor::with(['subscriptionPlan'])->findOrFail($factor_id);

        parent::mount($this->factor->company_id);
    }

    public function render()
    {
        return view('factor.details');
    }
}
