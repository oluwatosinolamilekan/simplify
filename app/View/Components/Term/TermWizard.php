<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Term;

use App\Models\Factor;
use App\Models\FeeRule;
use App\Models\Term;
use App\Models\TermSettings;
use App\Support\Validation\ValidationRules;
use App\View\Components\Component;
use App\View\Components\Traits\WithNested;
use Auth;
use DB;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Throwable;

/**
 * Class TermWizard.
 */
class TermWizard extends Component
{
    use WithNested;

    public Term $term;
    public Factor $factor;
    public TermSettings $settings;
    public Collection $clients;
    public Collection $feeRules;

    /**
     * @param  $term_id
     * @throws Exception
     */
    public function mount($term_id = null)
    {
        $this->term = Term::with([
            'factor',
            'factor.company',
            'factor.clients',
            'clients',
            'feeRules',
            'settings',
        ])->findOrNew($term_id);

        $this->initRelated();
    }

    /* Realtime validation */

    public function updated($property)
    {
        $this->validateOnly($property, $this->getRules() + $this->getConfigurationRules());
    }

    /**
     * @throws Exception|Throwable
     */
    public function save()
    {
        $this->validate($this->getRules() + $this->getConfigurationRules());

        // TODO @Jovana: should be separate service + reusable middlewares

        try {
            DB::beginTransaction();

            $this->term->save();

            $this->settings->term()->associate($this->term);
            $this->settings->save();

            $attributes = ['factor_id' => $this->term->factor_id, 'created_by' => Auth::user()->id];

            $this->term->clients()->syncWithPivotValues($this->clients, $attributes);

            $this->term->syncFeeRules($this->feeRules);

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
        $this->settings = $this->term->getRelatedInstanceOrNew('settings');
        $this->factor = $this->term->getRelatedInstanceOrNew('factor');
        $this->clients = $this->term->clients;
        $this->feeRules = $this->term->feeRules;
    }

    public function assignClient($id)
    {
        $this->clients->add($this->factor->clients->where('id', $id)->first());
    }

    public function detachClient($id)
    {
        $this->clients = $this->clients->reject(fn ($item) => $item->id == $id);
    }

    public function clientOptions()
    {
        // Only selected factor's clients allowed
        // filter already selected / assigned clients
        return $this->factor->clients->whereNotIn('id', $this->clients->pluck('id'));
    }

    public function updatedTermFactorId()
    {
        $this->factor = $this->term->getRelatedInstanceOrNew('factor', true);
        $this->clients = Collection::empty(); // empty selected clients collection since factor has been changed
    }

    public function selectFeeRuleType(int $type)
    {
        $this->feeRules->add(FeeRule::fromType($type));
    }

    public function deleteRule(int $index)
    {
        $this->feeRules->forget($index);
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
            ValidationRules::forModel('term', $this->term),
            ValidationRules::forModel('settings', $this->settings),
            ValidationRules::forCollection('feeRules', new FeeRule())
        );
    }

    // Keep validation rules for configuration array separately and use it only for validation purposes
    // as hydrate fails for json fields
    public function getConfigurationRules()
    {
        return ValidationRules::forProperty('feeRules.*.configuration', (new FeeRule())->getConfigurationRules())->getRules();
    }

    // Custom validation messages
    public function getMessages()
    {
        return $this->settings->getMessages();
    }

    // Custom validation attribute names
    public function getValidationAttributes()
    {
        return (new FeeRule())->getValidationAttributes('feeRules.*');
    }
}
