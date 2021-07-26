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
use App\Models\DebtorSettings;
use App\Support\Validation\ValidationRules;
use App\View\Components\Company\CompanyComponent;
use DB;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Throwable;

/**
 * Class DebtorWizard.
 */
class DebtorWizard extends CompanyComponent
{
    public Debtor $debtor;
    public DebtorSettings $settings;
    public DebtorCredit $credit;
    public DebtorCreditLimit $creditLimit;

    /**
     * @param  $debtor_id
     * @throws Exception
     */
    public function mount($debtor_id = null)
    {
        $this->debtor = Debtor::with([
            'company',
            'factor',
            'factor.company',
            'client',
            'client.company',
            'settings',
        ])->findOrNew($debtor_id);

        parent::mount($this->debtor->getRelatedInstanceOrNew('company'));
    }

    /**
     * @throws Exception
     */
    public function save()
    {
        $this->debtor->getRelatedInstanceOrNew('client', true);
        $this->debtor->factor_id = $this->debtor->client->factor_id;

        $this->validate();

        // TODO @Jovana: should be separate service + reusable middlewares

        try {
            DB::beginTransaction();

            $this->company->save();

            $this->debtor->company()->associate($this->company);
            $this->debtor->save();

            if ($this->settings->isDirty()) {
                $this->settings->debtor()->associate($this->debtor);
                $this->settings->save();
            }

            DB::commit();

            $this->successAlert();
        } catch (Throwable $exception) {
            DB::rollBack();
            $this->exceptionAlert($exception);
        }

        $this->initRelated();
    }

    /**
     * @throws Exception
     */
    public function initRelated()
    {
        parent::initRelated();

        $this->settings = $this->debtor->getRelatedInstanceOrNew('settings', true);
        $this->credit = $this->debtor->getRelatedInstanceOrNew('credit');
        $this->creditLimit = $this->debtor->getRelatedInstanceOrNew('creditLimit');
    }

    /**
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('debtors.wizard');
    }

    /**
     * @return array
     */
    public function getRules()
    {
        /** Ignore debtor_id change as debtor_id is set by default */
        $this->settings->isDirty('debtor_id') && $this->settings->ignoreDirty('debtor_id');

        return ValidationRules::merge(
            ValidationRules::forModel('company', $this->company),
            ValidationRules::forModel('debtor', $this->debtor),
            ValidationRules::forModel('settings', $this->settings, $this->settings->isDirty())
        );
    }
}
