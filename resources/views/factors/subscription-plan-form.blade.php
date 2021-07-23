

<div class="mt-5 md:mt-0 md:col-span-2">
    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
        <div class="grid grid-cols-6 gap-6">
            @foreach(\App\Models\SubscriptionPlan::active()->get() as $plan)
                <div class="col-span-6 sm:col-span-3">
                    <input wire:model="factor.subscription_plan_id" name="subscription_plan" type="radio" value="{{ $plan->id }}" />
                    {{ $plan->name }}
                </div>
            @endforeach
            <div class="col-span-6 sm:col-span-6">
                <x-jet-input-error for="factor.subscription_plan_id" class="mt-3" />
            </div>
        </div>
    </div>
</div>
