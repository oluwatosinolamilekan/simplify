<form wire:submit.prevent="save">
    <x-success-button wire:click="addSubscriptionPlan" type="button"> + Add New Subscription Plan </x-success-button>

    @foreach($subscriptionPlans as $index => $plan)
        @php $header = "{$plan->name} {$plan->price}$ {$plan->status->description}"; @endphp
        <x-collapsible-container :header="$header" :collapsed="true">
            <x-slot name="form">
                <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
                    <div class="grid grid-cols-6 gap-6">
                        @include('settings.subscription-plan.form', ['index' => $index])
                    </div>
                </div>
            </x-slot>
        </x-collapsible-container>
    @endforeach

    <!-- Actions -->
    @include('components.forms.form-actions', ['delete' => false])

</form>
