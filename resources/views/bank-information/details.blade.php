<div class="mt-5 md:mt-0 md:col-span-2">
    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
        <div class="grid grid-cols-6 gap-6">

            <!-- Bank Name -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="bank_name" value="{{ __('Bank Name') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $bankInformation->bank_name }}
                </span>
            </div>

            <!-- Account Holder Name -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="account_holder_name" value="{{ __('Account Holder Name') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $bankInformation->account_holder_name }}
                </span>
            </div>

            <!-- Account Number -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="account_number" value="{{ __('Account Number') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $bankInformation->account_number }}
                </span>
            </div>

            <!-- Routing Number -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="routing_number" value="{{ __('Routing Number') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $bankInformation->routing_number }}
                </span>
            </div>

            <!-- Swift Code -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="swift_code" value="{{ __('Swift Code') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $bankInformation->swift_code }}
                </span>
            </div>


        </div>
    </div>
</div>

