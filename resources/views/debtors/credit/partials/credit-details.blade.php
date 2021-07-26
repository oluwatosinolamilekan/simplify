
<div class="mt-5 md:mt-0 md:col-span-2">
    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
        <div class="grid grid-cols-6 gap-6">

            <!-- Annual Sales -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="credit_rating" value="{{ __('Annual Sales') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $credit->annual_sales }}
                </span>
            </div>

            <!-- Net Worth -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="credit_rating" value="{{ __('Net Worth') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $credit->net_worth }}
                </span>
            </div>

            <!-- Notes -->
            <div class="col-span-6 sm:col-span-6">
                <x-jet-label for="warning_note" value="{{ __('Notes') }}"/>

                <div class="col-span-6 sm:col-span-4 offset-2">
                    @foreach($credit->notes ?? [] as $i => $note)
                        <div>
                            <span class="text-wrap mx-2 py-3 sm:inline-block w-5/6">{{$note}}</span>
                        </div>

                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>
