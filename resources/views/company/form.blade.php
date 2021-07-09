
<div class="mt-5 md:mt-0 md:col-span-2">
    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
        <div class="grid grid-cols-6 gap-6">

            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model="company.name" autocomplete="organization" />
                <x-jet-input-error for="company.name" class="mt-2" />
            </div>

            <!-- Domain -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="domain" value="{{ __('Domain') }}" />
                <x-jet-input id="domain" type="text" class="mt-1 inline w-1/2" wire:model="company.domain"/>
                <span class="font-bold">.{{getenv('APP_BASE_DOMAIN')}}</span>
                <x-jet-input-error for="company.domain" class="mt-2" />
            </div>


        </div>
    </div>
</div>

