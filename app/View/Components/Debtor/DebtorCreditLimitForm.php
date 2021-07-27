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
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;

/**
 * Class DebtorCreditLimitForm.
 */
class DebtorCreditLimitForm extends ModelForm
{
    /**
     * @var DebtorCreditLimit
     */
    public DebtorCreditLimit $creditLimit;

    /**
     * @var string|null
     */
    public ?string $note = null;

    /**
     * @return mixed|string
     */
    public function getProperty()
    {
        return 'creditLimit';
    }

    /**
     * updatedCreditLimitCreditDate hook
     * When credit limit date is update, months_good_for needs to be recalculated
     * Since direct property changes do not trigger Livewire hooks, parent needs to be explicitly informed about changes.
     */
    public function updatedCreditLimitCreditDate()
    {
        $this->creditLimit->calcMonthsGoodFor();

        if ($this->creditLimit->isDirty(['months_good_for'])) {
            $this->updatedWithParent('creditLimit.months_good_for', $this->creditLimit->months_good_for); // inform parent about update
        }
    }

    /**
     * updatedCreditLimitCreditExpiryDate hook
     * When credit limit date is update, months_good_for needs to be recalculated
     * Since direct property changes do not trigger Livewire hooks, parent needs to be explicitly informed about changes.
     */
    public function updatedCreditLimitCreditExpiryDate()
    {
        $this->creditLimit->calcMonthsGoodFor();

        if ($this->creditLimit->isDirty(['months_good_for'])) {
            $this->updatedWithParent('creditLimit.months_good_for', $this->creditLimit->months_good_for); // inform parent about update
        }
    }

    /**
     * @return Application|Factory|View|mixed
     */
    public function render()
    {
        return view('debtors.credit.partials.credit-limit-form');
    }

    /**
     * @throws ValidationException
     */
    public function addNote()
    {
        $this->validateOnly('note', ['note' => $this->getRules()['creditLimit.notes.*']]);

        $this->creditLimit->appendToJson('notes', $this->note);

        $this->updatedWithParent('creditLimit.notes', $this->creditLimit->notes); // inform parent about update

        $this->note = '';
    }

    /**
     * @param $index
     */
    public function deleteNote($index)
    {
        $this->creditLimit->removeJsonField('notes', $index, true);

        $this->updatedWithParent('creditLimit.notes', $this->creditLimit->notes); // inform parent about update
    }
}
