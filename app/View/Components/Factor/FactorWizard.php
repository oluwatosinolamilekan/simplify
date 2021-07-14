<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Factor;

use App\Models\Factor;
use App\View\Components\Company\CompanyComponent;
use App\View\Components\Traits\ConfirmModelDelete;
use DB;
use Throwable;

class FactorWizard extends CompanyComponent
{
    use ConfirmModelDelete;

    public Factor $factor;

    public function mount($factor_id = null)
    {
        $this->factor = Factor::with(['subscriptionPlan'])->findOrNew($factor_id);

        parent::mount($this->factor->company_id);
    }

    public function save()
    {
        $this->validate();

        // TODO @Jovana: should be separate service + reusable middlewares

        try {
            DB::beginTransaction();

            $this->company->save();

            if ($this->contact->isDirty()) {
                $this->saveContactDetails();
            }

            if ($this->address->isDirty()) {
                $this->saveAddressInformation();
            }

            if ($this->bankInformation->isDirty()) {
                $this->saveBankInformation();
            }

            if (! $this->factor->exists) {
                $this->saveUser();
            }

            $this->factor->company()->associate($this->company);
            $this->factor->save();

            DB::commit();

            $this->successAlert();

            $this->redirect(route('factors.view', ['factor_id' => $this->factor->id]));
        } catch (Throwable $exception) {
            DB::rollBack();
            $this->exceptionAlert($exception);
        }
    }

    public function render()
    {
        return view('factor.wizard');
    }

    public function getRules()
    {
        return array_merge(
            parent::getRules(),
            $this->factor->getRules(),
        );
    }

    public function getModel()
    {
        return $this->factor ?? null;
    }
}
