<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Settings;

use App\Models\SubscriptionPlan;
use App\Support\Validation\ValidationRules;
use App\View\Components\Component;
use DB;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Throwable;

class SubscriptionPlansForm extends Component
{
    public Collection $subscriptionPlans;
    public Collection $deleted;

    public function mount()
    {
        $this->subscriptionPlans = SubscriptionPlan::active()->get();
        $this->deleted = new Collection();
    }

    public function save()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $this->subscriptionPlans->each(fn ($item) => $item->save());
            $this->deleted->each(fn ($item) => $item->delete());

            DB::commit();

            $this->successAlert();
        } catch (Throwable $exception) {
            DB::rollBack();
            $this->exceptionAlert($exception);
        }
    }

    public function addSubscriptionPlan()
    {
        $this->subscriptionPlans->add(new SubscriptionPlan());
    }

    public function deleteSubscriptionPlan($index)
    {
        $plan = $this->subscriptionPlans->get($index);

        if ($plan->factors()->exists()) {
            $this->exceptionAlert(new Exception('This plan is in use and can not be deleted!'));
        } else {
            $this->deleted->add($plan);
            $this->subscriptionPlans->forget($index);
        }
    }

    /**
     * @return array
     */
    public function getRules()
    {
        return ValidationRules::merge(
            ValidationRules::forCollection('subscriptionPlans', new SubscriptionPlan())
        );
    }

    // Custom validation attribute names
    public function getValidationAttributes()
    {
        return (new SubscriptionPlan())->getValidationAttributes('subscriptionPlans.*');
    }

    public function render()
    {
        return view('settings.subscription-plan.list');
    }
}
