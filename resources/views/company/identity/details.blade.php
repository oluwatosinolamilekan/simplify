
<div class="mt-5 md:mt-0 md:col-span-2">
    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
        <div class="grid grid-cols-6 gap-6">

            <!-- Company Code -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="company_code" value="{{ __('Company Code') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $identity->company_code }}
                </span>
            </div>

            <!-- Alternate Name -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="alternate_name" value="{{ __('Alternate Name') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $identity->alternate_name }}
                </span>
            </div>

            <!-- MC Number -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="mc_number" value="{{ __('MC Number') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $identity->mc_number }}
                </span>
            </div>

            <!-- DOT Number -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="dot_number" value="{{ __('DOT Number') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $identity->dot_number }}
                </span>
            </div>

            <!-- Fed Tax ID -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="fed_tax_id" value="{{ __('Federal Tax ID') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $identity->fed_tax_id }}
                </span>
            </div>

            <!-- EDI ID -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="edi_id" value="{{ __('EDI ID') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $identity->edi_id }}
                </span>
            </div>

            <!-- DUNS ID -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="duns_id" value="{{ __('DUNS ID') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $identity->duns_id }}
                </span>
            </div>


        </div>
    </div>
</div>
