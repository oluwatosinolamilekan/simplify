
<div class="mt-5 md:mt-0 md:col-span-2">
    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
        <div class="grid grid-cols-6 gap-6">


            <!-- Bank Name -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="bank_name" value="{{ __('Bank Name') }}" />
                <x-jet-input id="bank_name" type="text" class="mt-1 block w-full" wire:model.defer="bankInformation.bank_name" autocomplete="organization"/>
                <x-jet-input-error for="bankInformation.bank_name" class="mt-2" />
            </div>

            <!-- Account Holder Name -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="account_holder_name" value="{{ __('Account Holder Name') }}" />
                <x-jet-input id="account_holder_name" type="text" class="mt-1 block w-full" wire:model.defer="bankInformation.account_holder_name" autocomplete="name"/>
                <x-jet-input-error for="bankInformation.account_holder_name" class="mt-2" />
            </div>

            <!-- Account Number -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="account_number" value="{{ __('Account Number') }}" />
                <x-jet-input id="account_number" type="text" class="mt-1 block w-full" wire:model.defer="bankInformation.account_number"/>
                <x-jet-input-error for="bankInformation.account_number" class="mt-2" />
            </div>

            <!-- Routing Number -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="routing_number" value="{{ __('Routing Number') }}" />
                <x-jet-input id="routing_number" type="text" class="mt-1 block w-full" wire:model.defer="bankInformation.routing_number"/>
                <x-jet-input-error for="bankInformation.routing_number" class="mt-2" />
            </div>

            <!-- Swift Code -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="swift_code" value="{{ __('Swift Code') }}" />
                <x-jet-input id="swift_code" type="text" class="mt-1 block w-full" wire:model.defer="bankInformation.swift_code"/>
                <x-jet-input-error for="bankInformation.swift_code" class="mt-2" />
            </div>


        </div>
    </div>
</div>

