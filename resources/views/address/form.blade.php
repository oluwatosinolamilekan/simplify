
    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
        <div class="grid grid-cols-6 gap-6">

            <!-- Street -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="street" value="{{ __('Street') }}" />
                <x-jet-input id="street" type="text" class="mt-1 block w-full" wire:model="address.street" autocomplete="street-address"/>
                <x-jet-input-error for="address.street" class="mt-2" />
            </div>

            <!-- City -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="city" value="{{ __('City') }}" />
                <x-jet-input id="city" type="text" class="mt-1 block w-full" wire:model="address.city"/>
                <x-jet-input-error for="address.city" class="mt-2" />
            </div>

            <!-- State -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="state" value="{{ __('State') }}" />
                <x-jet-input id="state" type="text" class="mt-1 block w-full" wire:model="address.state"/>
                <x-jet-input-error for="address.state" class="mt-2" />
            </div>

            <!-- Country -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="country" value="{{ __('Country') }}" />
                <select id="country" wire:model="address.country" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    <option value="">Select Country</option>
                    <option value="us">US</option>
                    <option value="es">Spain</option>
                </select>
                <x-jet-input-error for="model.country" class="mt-2" />
            </div>

            <!-- ZIP Code -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="zip_code" value="{{ __('ZIP Code') }}" />
                <x-jet-input id="zip_code" type="text" class="mt-1 block w-full" wire:model="address.zip_code" autocomplete="postal-code"/>
                <x-jet-input-error for="address.zip_code" class="mt-2" />
            </div>

            <!-- Mail Code -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="mail_code" value="{{ __('Mail Code') }}" />
                <x-jet-input id="mail_code" type="text" class="mt-1 block w-full" wire:model="address.mail_code"/>
                <x-jet-input-error for="address.mail_code" class="mt-2" />
            </div>

            <!-- Timezone -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="timezone" value="{{ __('Timezone') }}" />
                <x-jet-input id="timezone" type="text" class="mt-1 block w-full" wire:model="address.timezone"/>
                <x-jet-input-error for="address.timezone" class="mt-2" />
            </div>


        </div>
    </div>


