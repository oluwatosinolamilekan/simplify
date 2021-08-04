<div class="col-span-6 sm:col-span-3">
    <x-jet-label for="feeRules.{{$index}}.start_day" value="{{ __('Start Day') }}" />
    <x-jet-input type="text" class="w-1/2 float-right" wire:model="feeRules.{{$index}}.configuration.start_day" />
    <x-jet-input-error for="feeRules.{{$index}}.configuration.start_day" class="mt-3" />
</div>

<div class="col-span-6 sm:col-span-3">
    <x-jet-label for="feeRules.{{$index}}.interval" value="{{ __('Interval') }}" />
    <x-forms.currency-input wire:model="feeRules.{{$index}}.configuration.interval" />
    <x-jet-input-error for="feeRules.{{$index}}.configuration.interval" class="mt-3" />
</div>

<div class="col-span-6 sm:col-span-3">
    <x-jet-label for="feeRules.{{$index}}.rate" value="{{ __('Rate') }}" />
    <x-forms.rate-input wire:model="feeRules.{{$index}}.rate" />
    <x-jet-input-error for="feeRules.{{$index}}.rate" class="mt-3" />
</div>

<div class="col-span-6 sm:col-span-3">
    <x-jet-label for="feeRules.{{$index}}.max_rate" value="{{ __('Max Rate') }}" />
    <x-forms.rate-input wire:model="feeRules.{{$index}}.configuration.max_rate" />
    <x-jet-input-error for="feeRules.{{$index}}.configuration.max_rate" class="mt-3" />
</div>

<div class="col-span-6 sm:col-span-3">
    <x-jet-label value="{{ __('Calculate Age Based On') }}" />
    @php
        $types = collect(\App\Enums\BaseDateType::getInstances())
                    ->map(fn ($type) => [
                        'id' => $type->value,
                        'name' => $type->description
                    ])
    @endphp

    <x-searchable-select :values="$types" wire:model="feeRules.{{$index}}.configuration.calculate_age_based_on" class="w-1/2 float-right"/>
</div>
