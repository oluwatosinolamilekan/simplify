<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Term;

use App\Models\Term;
use App\Models\TermFeeRules;
use App\Support\Validation\ValidationRules;
use App\View\Components\Component;
use App\View\Components\Traits\WithNested;
use DB;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Throwable;

/**
 * Class TermWizard.
 */
class TermWizard extends Component
{
    use WithNested;

    public Term $term;
    public TermFeeRules $feeRule;

    /**
     * @param  $term_id
     * @throws Exception
     */
    public function mount($term_id = null)
    {
        $this->term = Term::with([
            'factor',
            'factor.company',
            'clients',
            'feeRules',
        ])->findOrNew($term_id);
    }

    /**
     * @throws Exception|Throwable
     */
    public function save()
    {
        $this->validate();

        // TODO @Jovana: should be separate service + reusable middlewares

        try {
            DB::beginTransaction();

            $this->term->save();

            DB::commit();

            $this->successAlert();
        } catch (Throwable $exception) {
            DB::rollBack();
            $this->exceptionAlert($exception);
        }
    }

    /**
     * @throws Exception
     */
    public function initRelated()
    {
        // TODO: implement
    }

    /**
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('terms.wizard');
    }

    /**
     * @return array
     */
    public function getRules()
    {
        return ValidationRules::merge(
            ValidationRules::forModel('term', $this->term)
        );
    }
}
