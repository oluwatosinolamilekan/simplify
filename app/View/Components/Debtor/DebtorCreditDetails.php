<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Debtor;

use App\Models\Debtor;
use App\Models\DebtorCredit;
use App\Models\DebtorCreditLimit;
use App\Support\Validation\ValidationRules;
use App\View\Components\Component;
use App\View\Components\Traits\WithNested;
use Exception;

class DebtorCreditDetails extends Component
{
    use WithNested;

    public Debtor $debtor;
    public DebtorCredit $credit;
    public DebtorCreditLimit $creditLimit;

    /**
     * @param  $debtor
     * @throws Exception
     */
    public function mount($debtor)
    {
        $this->debtor = $debtor->load(['credit', 'creditLimit']);

        $this->initRelated();
    }

    public function render()
    {
        return view('debtors.credit.details');
    }

    /**
     * @throws Exception
     */
    public function initRelated()
    {
        $this->credit = $this->debtor->getRelatedInstanceOrNew('credit');
        $this->creditLimit = $this->debtor->getRelatedInstanceOrNew('creditLimit');
    }

    public function getRules()
    {
        return ValidationRules::merge(
            ValidationRules::forModel('credit', $this->credit, $this->credit->isDirty()),
            ValidationRules::forModel('creditLimit', $this->creditLimit, $this->creditLimit->isDirty())
        );
    }
}
