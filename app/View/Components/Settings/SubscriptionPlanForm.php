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
use App\View\Components\ModelForm;
use Exception;
use Throwable;

class SubscriptionPlanForm extends ModelForm
{
    public SubscriptionPlan $plan;
    public int $index;

    public function mount($plan)
    {
        $this->plan = $plan;
    }

    public function getProperty()
    {
        return 'plan';
    }

    public function deleteModel()
    {
        try {
            if (! $this->plan->exists) {
                $this->emitUp('removePlan', $this->index);
            }

            if ($this->plan->factors()->exists()) {
                throw new Exception('This plan is in use and can not be deleted!');
            }

            $this->plan->delete();
        } catch (Throwable $exception) {
            $this->exceptionAlert($exception);
        }
    }

    public function render()
    {
        return view('settings.subscription-plan.form');
    }
}
