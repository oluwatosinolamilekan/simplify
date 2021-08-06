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
use App\Support\Validation\ValidationRules;
use App\View\Components\Component;
use DB;
use Illuminate\Database\Eloquent\Collection;
use Throwable;

class NfeModelsForm extends Component
{
    public Collection $models;
    public Collection $deleted;

    public function mount()
    {
        $this->models = NFEModel::get();
        $this->deleted = new Collection();
    }

    public function save()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $this->models->each(fn ($item) => $item->save());
            $this->deleted->each(fn ($item) => $item->delete());

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
        $this->deleted->add($this->models->get($index));
        $this->models->forget($index);
    }

    /**
     * @return array
     */
    public function getRules()
    {
        return ValidationRules::merge(
            ValidationRules::forCollection('models', new NFEModel())
        );
    }

    // Custom validation attribute names
    public function getValidationAttributes()
    {
        return (new NFEModel())->getValidationAttributes('models.*');
    }

    public function render()
    {
        return view('settings.nfe-models.list');
    }
}
