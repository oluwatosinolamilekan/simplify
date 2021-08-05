@php
    $type = $feeRule->configuration['rate_type'];
    $label = $type == \App\Enums\RateType::Amount ? 'Amount' : 'Rate';
    $sign = $type == \App\Enums\RateType::Amount ? '$' : '%';
@endphp

<div class="col-span-6 sm:col-span-3">
    <x-jet-label value="{{ $label }}" />
    <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
        {{ $feeRule->rate }} {{ $sign }}
    </span>
</div>
