
<div class="col-span-6 sm:col-span-3">
    <x-jet-label value="{{ __('Type') }}" />
    @php
        $types = collect(\App\Enums\RateType::getInstances())
                    ->map(fn ($type) => [
                        'id' => $type->value,
                        'name' => $type->description
                    ])
    @endphp

    <x-searchable :values="$types" wire:model="feeRules.{{$index}}.configuration.rate_type" class="w-1/2 float-right"/>
</div>

<div class="col-span-6 sm:col-span-3">
    <x-jet-label for="feeRules.{{$index}}.rate" value="{{ __('Amount') }}" />
    @if(isset($feeRules[$index]->configuration['rate_type']) && $feeRules[$index]->configuration['rate_type'] == \App\Enums\RateType::Amount)
        <x-forms.currency-input wire:model="feeRules.{{$index}}.rate" />
    @else
        <x-forms.rate-input wire:model="feeRules.{{$index}}.rate" />
    @endif
    <x-jet-input-error for="feeRules.{{$index}}.rate" class="mt-3" />
</div>
