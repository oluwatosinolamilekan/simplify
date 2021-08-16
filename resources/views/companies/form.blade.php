
<div class="mt-5 md:mt-0 md:col-span-2">
    <div class="px-4 py-5 bg-white dark:bg-dark-2 sm:p-6 shadow sm:rounded-md">
        <div class="grid grid-cols-6 gap-6">

            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="company-name" value="{{ __('Name') }}" />
                <x-jet-input id="company-name" type="text" wire:model="company.name" class="w-1/2 float-right" autocomplete="organization" />
                <x-jet-input-error for="company.name" class="mt-3" />
            </div>

            <!-- Domain -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="domain" value="{{ __('Domain') }}" />
                <div class="inline-block sm:inline-block w-1/2 float-right">
                    <x-jet-input id="domain" type="text" wire:model="company.domain"/>

                </div>
                <x-jet-input-error for="company.domain" class="mt-3" />
            </div>
            <div class="col-span-6 sm:col-span-2">
                <span class="font-bold mt-1 sm:inline-block py-2">.{{getenv('APP_BASE_DOMAIN')}}</span>
            </div>


        </div>
    </div>
</div>

