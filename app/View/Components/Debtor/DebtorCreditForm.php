<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Debtor;

use App\Models\DebtorCredit;
use App\View\Components\ModelForm;

class DebtorCreditForm extends ModelForm
{
    public DebtorCredit $credit;

    public function getProperty()
    {
        return 'credit';
    }

    public function render()
    {
        return view('debtors.credit.partials.credit-form');
    }
}
