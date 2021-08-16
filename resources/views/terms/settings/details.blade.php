<div class="mt-5 md:mt-0 md:col-span-2" >
    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
        <div class="grid grid-cols-6 gap-6">

            <!-- Advance Rate -->
            <div class="col-span-3 sm:col-span-4">
                <x-jet-label for="advance_rate" value="{{ __('Advance Rate') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $settings->advance_rate }}
                </span>
            </div>

            <!-- Purchase Fee Rate -->
            <div class="col-span-3 sm:col-span-4">
                <x-jet-label for="purchase_fee_rate" value="{{ __('Purchase Fee Rate') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $settings->purchase_fee_rate }}
                </span>
            </div>

            <!-- Escrow Rate -->
            <div class="col-span-3 sm:col-span-4">
                <x-jet-label for="escrow_rate" value="{{ __('Escrow Rate') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $settings->escrow_rate }}
                </span>
            </div>

            <div class="col-span-6 sm:col-span-6">
                <x-jet-section-border />
            </div>

            <!-- Minimum Fee Per Invoice -->
            <div class="col-span-3 sm:col-span-4">
                <x-jet-label for="minimum_fee_per_invoice" value="{{ __('Minimum Fee Per Invoice') }}"/>
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $settings->minimum_fee_per_invoice }}
                </span>
            </div>

            <!-- Minimum Fee Applied To Non Advanced Loads -->
            <div class="col-span-3 sm:col-span-4">
                <x-jet-label for="minimum_fee_applied_to_non_advanced_loads" value="{{ __('Applied To Non Advanced Loads') }}" class="sm:inline-block"/>
                @if($settings->minimum_fee_applied_to_non_advanced_loads)
                    <x-icons.circle-check class="text-green-600 mx-0 inline" />
                @else
                    <x-icons.circle-x class="text-red-300 mx-0 inline" />
                @endif
            </div>

            <!-- Prioritize Minimum Fee -->
            <div class="col-span-3 sm:col-span-4">
                <x-jet-label for="prioritize_minimum_fee" value="{{ __('Minimum Fee Calculated Before Extra Fees') }}" class="sm:inline-block"/>
                @if($settings->prioritize_minimum_fee)
                    <x-icons.circle-check class="text-green-600 mx-0 inline" />
                @else
                    <x-icons.circle-x class="text-red-300 mx-0 inline" />
                @endif
            </div>

            <div class="col-span-6 sm:col-span-6">
                <x-jet-section-border />
            </div>

            <!-- Collection Fee Rule -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="collection_fee_rule" value="{{ __('Collection Fee Relative To') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $settings->collection_fee_rule->description }}
                </span>
            </div>

            <!-- Escrow Rebate Rule -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="escrow_rebate_rule" value="{{ __('Release Escrow Upon') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $settings->escrow_rebate_rule->description }}
                </span>
            </div>

            <!-- Fee Base Date -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="fee_base_date" value="{{ __('Calculate Fees Based On') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $settings->fee_base_date->description }}
                </span>
            </div>

            <!-- Rate Base Date -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="rate_base_type" value="{{ __('Calculate Rates Based On') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $settings->rate_base_type->description }}
                </span>
            </div>

            <!-- Float Days Type -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="float_days_type" value="{{ __('Float Days') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $settings->float_days_type->description }}
                </span>
            </div>

        </div>
    </div>
</div>
