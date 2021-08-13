
<div class="mt-5 md:mt-0 md:col-span-2">
    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
        <div class="grid grid-cols-6 gap-6">

            <!-- Approved -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="ref_code" value="{{ __('Approved') }}" />
                @if($credit->approved)
                    <x-icons.circle-check class="text-green-600 mx-0 inline" />
                @else
                    <x-icons.circle-x class="text-red-300 mx-0 inline" />
                @endif
            </div>

            <x-forms.border />

            <!-- Credit Rating -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="credit_rating" value="{{ __('Credit Rating') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $credit->credit_rating }}
                </span>
            </div>

            <!-- Credit Limit -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="credit_limit" value="{{ __('Credit Limit') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $credit->credit_limit }}
                </span>
            </div>

            <!-- Debtor Limit -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="debtor_limit" value="{{ __('Debtor Limit') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $credit->debtor_limit }}
                </span>
            </div>

            <!-- Debtor Concentration -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="debtor_concentration" value="{{ __('Debtor Concentration') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $credit->debtor_concentration }}
                </span>
            </div>

            <x-forms.border />

            <!-- Standard Terms -->
            <div class="col-span-3 sm:col-span-3">
                <x-jet-label for="standard_terms" value="{{ __('Standard Terms') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $credit->standard_terms }}
                </span>
            </div>

            <!-- Ineligible Days -->
            <div class="col-span-3 sm:col-span-3">
                <x-jet-label for="ineligible_days" value="{{ __('Ineligible Days') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $credit->ineligible_days }}
                </span>
            </div>

            <x-forms.border />

            <!-- Charge Report -->
            <div class="col-span-3 sm:col-span-3">
                <x-jet-label for="report_charge" value="{{ __('Charge Report') }}"  class="sm:inline-block"/>
                @if($credit->report_charge)
                    <x-icons.circle-check class="text-green-600 mx-0 inline" />
                @else
                    <x-icons.circle-x class="text-red-300 mx-0 inline" />
                @endif
            </div>

            <!-- Report Charge Amount -->
            <div class="col-span-3 sm:col-span-3">
                <x-jet-label for="report_charge_amount" value="{{ __('Report Charge Amount') }}" class="sm:inline-block"/>
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $credit->report_charge_amount }}
                </span>
            </div>

            <x-forms.border />

            <!-- UCC Date -->
            <div class="col-span-3 sm:col-span-3">
                <x-jet-label for="ucc_date" value="{{ __('UCC Date') }}" class="sm:inline-block"/>
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $credit->ucc_date }}
                </span>
            </div>

            <!-- UCC Date 2 -->
            <div class="col-span-3 sm:col-span-3">
                <x-jet-label for="ucc_date_2" value="{{ __('UCC Date 2') }}" class="sm:inline-block"/>
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $credit->ucc_date_2 }}
                </span>
            </div>

            <!-- UCC Expiring Date -->
            <div class="col-span-3 sm:col-span-3">
                <x-jet-label for="ucc_expiring_date" value="{{ __('UCC Expiring Date') }}" class="sm:inline-block"/>
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $credit->ucc_expiring_date }}
                </span>
            </div>

        </div>
    </div>
</div>
