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
use App\Models\SubscriptionPlan;
use App\View\Components\Component;
use Illuminate\Database\Eloquent\Collection;

class SettingsForm extends Component
{
    public Collection $models;
    public Collection $plans;

    protected $listeners = ['planDeleted' => 'deletePlan', 'modelDeleted' => 'deleteModel'];

    public function mount()
    {
        $this->models = NFEModel::get();
        $this->plans = SubscriptionPlan::get();
    }

    public function addModel()
    {
        $this->models->add(new NFEModel());
    }

    public function addPlan()
    {
        $this->plans->add(new SubscriptionPlan());
    }

    public function render()
    {
        return view('settings.form');
    }
}
