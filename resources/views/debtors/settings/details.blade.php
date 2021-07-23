
<div class="mt-5 md:mt-0 md:col-span-2">
    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
        <div class="grid grid-cols-6 gap-6">

            <!-- Buy Status -->
            <div class="col-span-3 sm:col-span-3">
                <x-jet-label for="buy_status" value="{{ __('Buy / No Buy') }}"  class="sm:inline-block"/>
                @if($settings->buy_status)
                    <x-icons.check-circle class="text-green-600 mx-0 inline" />
                @else
                    <x-icons.x-circle class="text-red-300 mx-0 inline" />
                @endif
            </div>

            <!-- Send Email Remittances -->
            <div class="col-span-3 sm:col-span-3">
                <x-jet-label for="do_not_contact" value="{{ __('Do Not Contact') }}" class="sm:inline-block"/>
                @if($settings->do_not_contact)
                    <x-icons.check-circle class="text-green-600 mx-0 inline" />
                @else
                    <x-icons.x-circle class="text-red-300 mx-0 inline" />
                @endif
            </div>

            <!-- NOA Email -->
            <div class="col-span-6 sm:col-span-6">
                <x-jet-label for="noa_email" value="{{ __('NOA Email') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $settings->noa_email }}
                </span>
            </div>

            <!-- Require Original Invoices -->
            <div class="col-span-3 sm:col-span-3">
                <x-jet-label for="require_original_invoices" value="{{ __('Require Original Invoices') }}" class="sm:inline-block"/>
                @if($settings->require_original_invoices)
                    <x-icons.check-circle class="text-green-600 mx-0 inline" />
                @else
                    <x-icons.x-circle class="text-red-300 mx-0 inline" />
                @endif
            </div>

            <!-- Warning Notes -->
            <div class="col-span-6 sm:col-span-6">
                <x-jet-label for="warning_note" value="{{ __('Warning Notes') }}"/>
                <div class="col-span-6 sm:col-span-4 offset-2">
                    @foreach($settings->warning_notes as $i => $note)
                        <div>
                            <span class="text-wrap mx-2 py-3 sm:inline-block w-5/6">{{$note}}</span>
                        </div>

                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>
