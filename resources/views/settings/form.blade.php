<x-slot name="header">
    {{ __('Settings') }}
</x-slot>


<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <x-tabs tabs='{
        "subscription_plans": "Subscription Plans",
        "nfe_models": "NFE Constants"
    }'>
        <x-slot name="subscription_plans">
            <x-success-button wire:click="addPlan" type="button"> + Add New Subscription Plan </x-success-button>

            @foreach($plans as $index => $plan)
                @php $header = $plan->id ? "{$plan->name} {$plan->price}$ {$plan->status->description}" : ""; @endphp
                <x-collapsible-container :header="$header" :collapsed="(bool)$plan->id">
                    <x-slot name="form">
                        <div class="px-4 py-5 bg-white dark:bg-dark-2 sm:p-6 shadow sm:rounded-md">
                            <livewire:settings.subscription-plan-form :plan="$plan" :index="$index" wire:key="plan-{{$index}}"/>
                        </div>
                    </x-slot>
                </x-collapsible-container>
            @endforeach
        </x-slot>
        <x-slot name="nfe_models">
            <x-success-button wire:click="addModel" type="button"> + Add New NFE Model </x-success-button>

            @foreach($models as $index => $model)
                <x-collapsible-container :header="$model->name" :collapsed="(bool)$model->id">
                    <x-slot name="form">
                        <div class="px-4 py-5 bg-white dark:bg-dark-2 sm:p-6 shadow sm:rounded-md">
                            <livewire:settings.nfe-model-form :model="$model" :index="$index" wire:key="model-{{$index}}"/>
                        </div>
                    </x-slot>
                </x-collapsible-container>
            @endforeach
        </x-slot>
    </x-tabs>
</div>
