
<div class="mt-5 md:mt-0 md:col-span-2">
    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
        <div class="grid grid-cols-6 gap-6">

            <!-- All Customer Limit -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="credit_rating" value="{{ __('All Customer Limit') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $creditLimit->all_customer_limit }}
                </span>
            </div>

            <!-- Months Good For -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="credit_rating" value="{{ __('Months Good For') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $creditLimit->months_good_for }}
                </span>
            </div>

            <!-- Credit Date -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="credit_rating" value="{{ __('Credit Date') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $creditLimit->credit_date }}
                </span>
            </div>

            <!-- Credit Expiring Date -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="credit_rating" value="{{ __('Credit Expiring Date') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $creditLimit->credit_expiry_date }}
                </span>
            </div>

            <!-- Notes -->
            <div class="col-span-6 sm:col-span-6">
                <x-jet-label for="warning_note" value="{{ __('Notes') }}"/>

                <div class="col-span-6 sm:col-span-4 offset-2">
                    @foreach($creditLimit->notes ?? [] as $i => $note)
                        <div>
                            <span class="text-wrap mx-2 py-3 sm:inline-block w-5/6">{{$note}}</span>
                        </div>

                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>
