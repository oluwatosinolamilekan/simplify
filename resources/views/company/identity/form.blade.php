
<div class="mt-5 md:mt-0 md:col-span-2">
    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
        <div class="grid grid-cols-6 gap-6">

            <!-- Company Code -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="company_code" value="{{ __('Company Code') }}" />
                <x-jet-input id="company_code" type="text" class="mt-1 block w-full" wire:model.defer="companyIdentity.company_code" />
                <x-jet-input-error for="companyIdentity.company_code" class="mt-2" />
            </div>

            <!-- Alternate Name -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="alternate_name" value="{{ __('Alternate Name') }}" />
                <x-jet-input id="alternate_name" type="text" class="mt-1 block w-full" wire:model.defer="companyIdentity.alternate_name" />
                <x-jet-input-error for="companyIdentity.alternate_name" class="mt-2" />
            </div>

            <!-- MC Number -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="mc_number" value="{{ __('MC Number') }}" />
                <x-jet-input id="mc_number" type="text" class="mt-1 block w-full" wire:model.defer="companyIdentity.mc_number" />
                <x-jet-input-error for="companyIdentity.mc_number" class="mt-2" />
            </div>

            <!-- DOT Number -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="dot_number" value="{{ __('DOT Number') }}" />
                <x-jet-input id="dot_number" type="text" class="mt-1 block w-full" wire:model.defer="companyIdentity.dot_number" />
                <x-jet-input-error for="companyIdentity.dot_number" class="mt-2" />
            </div>

            <!-- Fed Tax ID -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="fed_tax_id" value="{{ __('Federal Tax ID') }}" />
                <x-jet-input id="fed_tax_id" type="text" class="mt-1 block w-full" wire:model.defer="companyIdentity.fed_tax_id" />
                <x-jet-input-error for="companyIdentity.fed_tax_id" class="mt-2" />
            </div>

            <!-- EDI ID -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="edi_id" value="{{ __('EDI ID') }}" />
                <x-jet-input id="edi_id" type="text" class="mt-1 block w-full" wire:model.defer="companyIdentity.edi_id" />
                <x-jet-input-error for="companyIdentity.edi_id" class="mt-2" />
            </div>

            <!-- DUNS ID -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="duns_id" value="{{ __('DUNS ID') }}" />
                <x-jet-input id="duns_id" type="text" class="mt-1 block w-full" wire:model.defer="companyIdentity.duns_id" />
                <x-jet-input-error for="companyIdentity.duns_id" class="mt-2" />
            </div>


        </div>
    </div>
</div>
