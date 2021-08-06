<x-slot name="header">
    {{ __('Settings') }}
</x-slot>


<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <x-tabs tabs='{
        "subscription_plans": "Subscription Plans",
        "nfe_models": "NFE Constants"
    }'>
        <x-slot name="subscription_plans">
            <livewire:settings.subscription-plans-form :partial="false" :nested="false"/>
        </x-slot>
        <x-slot name="nfe_models"></x-slot>
    </x-tabs>
</div>
