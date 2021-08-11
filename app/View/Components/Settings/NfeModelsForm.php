<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Settings;

use App\Models\NFEModel;
use App\Models\NFEModelRate;
use App\Support\Validation\ValidationRules;
use App\View\Components\Component;
use DB;
use Illuminate\Database\Eloquent\Collection;
use Throwable;

class NfeModelsForm extends Component
{
    public Collection $models;
    public Collection $deletedModels;
    public Collection $rates;
    public Collection $deletedRates;

    public function mount()
    {
        $this->models = NFEModel::with(['rates'])->get();
        $this->deletedModels = new Collection();
        $this->deletedRates = new Collection();

        $this->rates = new Collection();
        foreach ($this->models as $model) {
            $this->rates->merge($model->rates);
        }
    }

    public function save()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $this->models->each(fn ($item) => $item->save());
            $this->deletedModels->each(fn ($item) => $item->delete());
            $this->rates->each(fn ($item) => $item->save());
            $this->deletedRates->each(fn ($item) => $item->delete());

            DB::commit();

            $this->successAlert();
        } catch (Throwable $exception) {
            DB::rollBack();
            $this->exceptionAlert($exception);
        }
    }

    public function addModel()
    {
        $this->models->add(new NFEModel());
    }

    public function deleteModel($index)
    {
        $this->deletedModels->add($this->models->get($index));
        $this->models->forget($index);
    }

    public function getModelRates($index)
    {
        $model = $this->models->get($index);

        return $this->rates->where('nfe_model_id', $model->id);
    }

    public function addModelRate($index)
    {
        $model = $this->models->get($index);
        $this->rates->add($model->rates()->make());
    }

    public function deleteModelRate($index)
    {
        $rate = $this->rates->get($index);

        if ($rate->id) {
            $this->deletedRates->add($rate);
        }

        $this->rates->forget($index);
    }

    /**
     * @return array
     */
    public function getRules()
    {
        return ValidationRules::merge(
            ValidationRules::forCollection('models', new NFEModel()),
            ValidationRules::forCollection('rates', new NFEModelRate())
        );
    }

    // Custom validation attribute names
    public function getValidationAttributes()
    {
        return array_merge(
            (new NFEModel())->getValidationAttributes('models.*'),
            (new NFEModelRate())->getValidationAttributes('rates.*')
        );
    }

    public function render()
    {
        return view('settings.nfe-models.list');
    }
}
