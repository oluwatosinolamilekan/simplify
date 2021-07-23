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
use App\Support\Validation\ValidationRules;
use App\View\Components\Company\CompanyComponent;
use DB;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Throwable;

/**
 * Class FactorWizard.
 */
class FactorWizard extends CompanyComponent
{
    public Factor $factor;

    /**
     * @param  $factor_id
     * @throws Exception
     */
    public function mount($factor_id = null)
    {
        $this->factor = Factor::with(['company', 'subscriptionPlan'])->findOrNew($factor_id);

        parent::mount($this->factor->getRelatedInstanceOrNew('company'));
    }

    /**
     * @throws Exception
     */
    public function save()
    {
        $this->validate();

        // TODO @Jovana: should be separate service + reusable middlewares

        try {
            DB::beginTransaction();

            $this->company->save();

            $this->factor->company()->associate($this->company);
            $this->factor->save();

            DB::commit();

            $this->successAlert();
        } catch (Throwable $exception) {
            DB::rollBack();
            $this->exceptionAlert($exception);
        }

        $this->initRelated();
    }

    /**
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('factors.wizard');
    }

    /**
     * @return array
     */
    public function getRules()
    {
        return ValidationRules::merge(
            ValidationRules::forModel('company', $this->company),
            ValidationRules::forModel('factor', $this->factor)
        );
    }
}
