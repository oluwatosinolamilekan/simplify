
<div class="grid grid-cols-6 gap-6">
    <!-- First Name -->
    <div class="col-span-6 sm:col-span-3">
        <x-jet-label for="first_name" value="{{ __('First Name') }}" />
        <x-jet-input id="first_name" type="text" class="mt-1 block w-full" wire:model.defer="userCompanyAccess.first_name" autocomplete="given-name" />
        <x-jet-input-error for="userCompanyAccess.first_name" class="mt-2" />
    </div>

    <!-- Last Name -->
    <div class="col-span-6 sm:col-span-3">
        <x-jet-label for="last_name" value="{{ __('Last Name') }}" />
        <x-jet-input id="last_name" type="text" class="mt-1 block w-full" wire:model.defer="userCompanyAccess.last_name" autocomplete="family-name" />
        <x-jet-input-error for="userCompanyAccess.last_name" class="mt-2" />
    </div>

    <!-- Middle Name -->
    <div class="col-span-6 sm:col-span-4">
        <x-jet-label for="middle_name" value="{{ __('Middle Name') }}" />
        <x-jet-input id="middle_name" type="text" class="mt-1 block w-full" wire:model.defer="userCompanyAccess.middle_name" autocomplete="additional-name" />
        <x-jet-input-error for="userCompanyAccess.middle_name" class="mt-2" />
    </div>

    <!-- Role -->
    <div class="col-span-6 sm:col-span-3">
        <x-jet-label for="role" value="{{ __('Role') }}" />
        <select id="role" wire:model.defer="userCompanyAccess.role" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" disabled>
            <option value="{{\App\Enums\Role::Administrator}}">{{\App\Enums\Role::Administrator()->description}}</option>
        </select>
        <x-jet-input-error for="userCompanyAccess.role" class="mt-2" />
    </div>

    <!-- Status -->
    <div class="col-span-6 sm:col-span-3">
        <x-jet-label for="status" value="{{ __('Status') }}" />
        <select id="status" wire:model.defer="userCompanyAccess.status" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
            <option value={{\App\Enums\Status::Active}} selected>
                {{ \App\Enums\Status::Active()->description }}
            </option>
            <option value={{\App\Enums\Status::NotActive}}>
                {{ \App\Enums\Status::NotActive()->description }}
            </option>
        </select>
        <x-jet-input-error for="userCompanyAccess.status" class="mt-2" />
    </div>
</div>


