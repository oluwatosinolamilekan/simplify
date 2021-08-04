@php
    use App\Enums\FeeRuleType;

    $views = [
        FeeRuleType::CollectionFee => 'terms.fee-rules.collection-fee-details',
        FeeRuleType::IntervalFee => 'terms.fee-rules.interval-fee-details',
        FeeRuleType::FlatFee => 'terms.fee-rules.flat-fee-details',
        FeeRuleType::NegativeReserveFee => 'terms.fee-rules.negative-reserve-fee-details',
        FeeRuleType::NFEFee => 'terms.fee-rules.nfe-fee-details',
    ];
    $header = "{$feeRule->label} [ {$feeRule->type->description} ]";
@endphp
<x-collapsible-container :header="$header" :collapsed="false">
    <x-slot name="form">
        <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
            <div class="grid grid-cols-6 gap-6">

                @include($views[$feeRule->type->value], ['feeRule' => $feeRule])
            </div>
        </div>
    </x-slot>
</x-collapsible-container>
