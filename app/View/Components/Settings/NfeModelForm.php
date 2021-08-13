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
use App\View\Components\ModelForm;
use DB;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Throwable;

class NfeModelForm extends ModelForm
{
    public NFEModel $model;
    public int $index;

    public Collection $rates;
    public Collection $deletedRates;

    public function mount($model)
    {
        $this->model = $model;
        $this->rates = $model->rates;

        $this->deletedRates = new Collection();
    }

    public function save()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $this->model->save();

            $this->rates->each(fn ($item) => $item->nfeModel()->associate($this->model) && $item->save());
            $this->deletedRates->each(fn ($item) => $item->delete());

            DB::commit();

            $this->successAlert();
        } catch (Throwable $exception) {
            DB::rollBack();
            $this->exceptionAlert($exception);
        }
    }

    public function addRate()
    {
        $this->rates->add($this->model->rates()->make());
    }

    public function deleteRate($index)
    {
        $this->deletedRates->add($this->rates->get($index));
        $this->rates->forget($index);
    }

    /**
     * @return array
     */
    public function getRules()
    {
        return ValidationRules::merge(
            ValidationRules::forModel('model', new NFEModel()),
            ValidationRules::forCollection('rates', new NFEModelRate())
        );
    }

    // Custom validation attribute names
    public function getValidationAttributes()
    {
        return ValidationRules::mergeAttributes(
            ValidationRules::attributesForModel(new NFEModel(), 'model'),
            ValidationRules::attributesForModel(new NFEModelRate(), 'rates.*')
        );
    }

    public function deleteModel()
    {
        try {
            if (! $this->model->exists) {
                $this->emitUp('removeModel', $this->index);
            }

            if ($this->model->feeRules()->exist()) {
                throw new Exception('This model is in use and can not be deleted!');
            }

            $this->model->delete();
        } catch (Throwable $exception) {
            $this->exceptionAlert($exception);
        }
    }

    public function getProperty()
    {
        return 'model';
    }

    public function render()
    {
        return view('settings.nfe-models.form');
    }
}
