
<!-- Name -->
<div class="col-span-6 sm:col-span-3">
    <x-jet-label for="subscriptionPlans.{{$index}}.name" value="{{ __('Name') }}" />
    <x-jet-input type="text" class="w-1/2 float-right" wire:model="subscriptionPlans.{{$index}}.name" />
    <x-jet-input-error for="subscriptionPlans.{{$index}}.name" class="mt-3" />
</div>

<!-- Price -->
<div class="col-span-6 sm:col-span-3">
    <x-jet-label for="subscriptionPlans.{{$index}}.price" value="{{ __('Price') }}" />
    <x-forms.currency-input wire:model="subscriptionPlans.{{$index}}.price" />
    <x-jet-input-error for="subscriptionPlans.{{$index}}.price" class="mt-3" />
</div>

<!-- Status -->
<div class="col-span-6 sm:col-span-3">
    <x-jet-label for="subscriptionPlans.{{$index}}.status" value="{{ __('Status') }}" />
    @php
        $statuses = collect(\App\Enums\StatusTypesList::Term)
                    ->map(fn ($status) => [
                        'id' => $status,
                        'name' => \App\Enums\Status::fromValue($status)->description
                    ])
    @endphp
    <x-select :values="$statuses" wire:model="subscriptionPlans.{{$index}}.status" class="w-1/2 float-right"/>
    <x-jet-input-error for="subscriptionPlans.{{$index}}.status" class="mt-3" />
</div>

<div class="col-span-6 sm:col-span-6">
    <x-jet-section-border />
    <x-danger-button wire:click="deleteSubscriptionPlan({{$index}})" class="float-right">Delete</x-danger-button>
</div>
