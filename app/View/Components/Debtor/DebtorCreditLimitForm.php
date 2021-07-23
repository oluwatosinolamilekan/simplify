<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Debtor;

use App\Models\DebtorCreditLimit;
use App\View\Components\ModelForm;

class DebtorCreditLimitForm extends ModelForm
{
    public DebtorCreditLimit $creditLimit;

    public function getProperty()
    {
        return 'creditLimit';
    }

    public function updatedCreditLimitCreditDate()
    {
        if ($this->creditLimit->credit_expiry_date) {
            $this->creditLimit->months_good_for = $this->creditLimit->credit_expiry_date->diffInMonths($this->creditLimit->credit_date);
        }
    }

    public function updatedCreditLimitCreditExpiryDate()
    {
        if ($this->creditLimit->credit_date) {
            $this->creditLimit->months_good_for = $this->creditLimit->credit_expiry_date->diffInMonths($this->creditLimit->credit_date);
        }
    }

    public function render()
    {
        return view('debtors.credit.partials.credit-limit-form');
    }
}
