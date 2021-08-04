
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
    <x-jet-label value="{{ __('Thru Day') }}" />
    <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
        {{ $feeRule->configuration['thru_day'] }}
    </span>
</div>
