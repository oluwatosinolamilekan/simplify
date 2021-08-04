<div class="col-span-6 sm:col-span-3">
    <x-jet-label value="{{ __('Rate') }}" />
    <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
        {{ $feeRule->rate }} %
    </span>
</div>

<div class="col-span-6 sm:col-span-3">
    <x-jet-label value="{{ __('Start Day') }}" />
    <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
        {{ $feeRule->configuration['start_day'] }}
    </span>
</div>

<div class="col-span-6 sm:col-span-3">
    <x-jet-label value="{{ __('Interval') }}" />
    <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
        {{ $feeRule->configuration['interval'] }}
    </span>
</div>

<div class="col-span-6 sm:col-span-3">
    <x-jet-label value="{{ __('Max Rate') }}" />
    <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
        {{ $feeRule->configuration['max_rate'] }} %
    </span>
</div>

<div class="col-span-6 sm:col-span-3">
    <x-jet-label value="{{ __('Calculate Age Based On') }}" />
    @php
        $type = \App\Enums\BaseDateType::fromValue($feeRule->configuration['calculate_age_based_on'])->description
    @endphp

    <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
        {{ $type }}
    </span>
</div>
