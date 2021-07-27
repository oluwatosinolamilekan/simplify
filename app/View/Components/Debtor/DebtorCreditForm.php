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

    public ?string $note = null;

    public function getProperty()
    {
        return 'credit';
    }

    public function render()
    {
        return view('debtors.credit.partials.credit-form');
    }

    public function addNote()
    {
        $this->validateOnly('note', ['note' => $this->getRules()['credit.notes.*']]);

        $this->credit->appendToJson('notes', $this->note);

        $this->updatedWithParent('credit.notes', $this->credit->notes); // inform parent about update

        $this->note = '';
    }

    public function deleteNote($index)
    {
        $this->credit->removeJsonField('notes', $index, true);

        $this->updatedWithParent('credit.notes', $this->credit->notes); // inform parent about update
    }
}
