@php
    use App\Enums\FeeRuleType;

    $views = [
        FeeRuleType::CollectionFee => 'terms.fee-rules.collection-fee-form',
        FeeRuleType::IntervalFee => 'terms.fee-rules.interval-fee-form',
        FeeRuleType::FlatFee => 'terms.fee-rules.flat-fee-form',
        FeeRuleType::NegativeReserveFee => 'terms.fee-rules.negative-reserve-fee-form',
        FeeRuleType::NFEFee => 'terms.fee-rules.nfe-fee-form',
    ];
@endphp
<x-collapsible-container :header="$feeRule->type->description" :collapsed="$feeRule->id ? 1 : 0">
    <x-slot name="form">
        <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
            <div class="grid grid-cols-6 gap-6">
                <!-- Label -->
                <div class="col-span-6 sm:col-span-3">
                    <x-jet-label for="feeRules.{{$index}}.label" value="{{ __('Label') }}" />
                    <x-jet-input type="text" class="w-1/2 float-right" wire:model="feeRules.{{$index}}.label" />
                    <x-jet-input-error for="feeRules.{{$index}}.label" class="mt-3" />
                </div>

                @include($views[$feeRule->type->value], ['feeRule' => $feeRule])
            </div>
        </div>
        <x-danger-button wire:click="deleteRule({{$index}})">Delete</x-danger-button>
    </x-slot>
</x-collapsible-container>
