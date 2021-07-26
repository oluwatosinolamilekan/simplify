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
use App\View\Components\ModelForm;
use App\View\Components\Traits\WithNested;
use DB;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

/**
 * Class DebtorCreditForm.
 */
class DebtorCreditMainForm extends ModelForm
{
    use WithNested;

    public Debtor $debtor;
    public DebtorCredit $credit;
    public DebtorCreditLimit $creditLimit;

    /** Mount with variadic arguments to support mounting with both ids and models.
     * @param array $params
     * @throws Exception
     */
    public function mount(...$params)
    {
        [$debtor] = $params;

        if (! is_int($debtor) && ! ($debtor instanceof Debtor)) {
            throw new Exception('Invalid mount argument');
        }

        if ($debtor instanceof Debtor) {
            $this->debtor = $debtor->load(['credit', 'creditLimit']);
        } else {
            $this->debtor = Debtor::with(['credit', 'creditLimit'])->findOrNew($debtor);
        }

        $this->initRelated();
    }

    /**
     * @throws Exception
     */
    public function initRelated()
    {
        $this->credit = $this->debtor->getRelatedInstanceOrNew('credit', true);
        $this->creditLimit = $this->debtor->getRelatedInstanceOrNew('creditLimit', true);
    }

    /**
     * @return array
     */
    public function getRules()
    {
        /** Ignore debtor_id change as debtor_id is set by default */
        $this->credit->isDirty('debtor_id') && $this->credit->ignoreDirty('debtor_id');
        $this->creditLimit->isDirty('debtor_id') && $this->creditLimit->ignoreDirty('debtor_id');

        return ValidationRules::merge(
            ValidationRules::forModel('credit', $this->credit, $this->credit->isDirty()),
            ValidationRules::forModel('creditLimit', $this->creditLimit, $this->creditLimit->isDirty())
        );
    }

    public function addNote()
    {
        // TODO @Jovana: validate only notes
    }

    public function deleteNote()
    {
        // TODO @Jovana: implement
    }

    /**
     * Save action for component model.
     */
    public function save()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $this->credit->save();
            $this->creditLimit->save();

            DB::commit();

            $this->successAlert();

            $this->emitUp('saved', $this->getProperty());
        } catch (Exception $exception) {
            DB::rollBack();
            $this->exceptionAlert($exception);
        }
    }

    /**
     * @return mixed|string
     */
    public function getProperty()
    {
        return 'credit';
    }

    /**
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('debtors.credit.form');
    }

    public function updatedCreditLimitCreditDate()
    {
        $this->creditLimit->calcMonthsGoodFor();
    }

    public function updatedCreditLimitCreditExpiryDate()
    {
        $this->creditLimit->calcMonthsGoodFor();
    }
}
