
    <!-- First Name -->
    <div class="col-span-6 sm:col-span-3">
        <x-jet-label for="first_name" value="{{ __('First Name') }}" />
        <x-jet-input id="first_name" type="text" class="mt-1 block w-full" wire:model="userCompanyAccess.first_name" autocomplete="given-name" />
        <x-jet-input-error for="userCompanyAccess.first_name" class="mt-2" />
    </div>

    <!-- Last Name -->
    <div class="col-span-6 sm:col-span-3">
        <x-jet-label for="last_name" value="{{ __('Last Name') }}" />
        <x-jet-input id="last_name" type="text" class="mt-1 block w-full" wire:model="userCompanyAccess.last_name" autocomplete="family-name" />
        <x-jet-input-error for="userCompanyAccess.last_name" class="mt-2" />
    </div>

    <!-- Middle Name -->
    <div class="col-span-6 sm:col-span-4">
        <x-jet-label for="middle_name" value="{{ __('Middle Name') }}" />
        <x-jet-input id="middle_name" type="text" class="mt-1 block w-full" wire:model="userCompanyAccess.middle_name" autocomplete="additional-name" />
        <x-jet-input-error for="userCompanyAccess.middle_name" class="mt-2" />
    </div>

    <!-- Role -->
    <div class="col-span-6 sm:col-span-3">
        <x-jet-label for="role" value="{{ __('Role') }}" />
        <select id="role" wire:model="userCompanyAccess.role" @if (count($roles) == 1) disabled @endif class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
            @foreach($roles as $role)
            <option value="{{$role}}" @if ($userCompanyAccess && $userCompanyAccess->role && $userCompanyAccess->role->is($role)) selected @endif>
                {{\App\Enums\Role::fromValue($role)->description}}
            </option>
            @endforeach
        </select>
        <x-jet-input-error for="userCompanyAccess.role" class="mt-2" />
    </div>

    <!-- Status -->
    <div class="col-span-6 sm:col-span-3">
        <x-jet-label for="user-access-status" value="{{ __('Status') }}" />
        <select id="user-access-status" wire:model="userCompanyAccess.status" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
            <option value={{\App\Enums\Status::Active}} selected>
                {{ \App\Enums\Status::Active()->description }}
            </option>
            <option value={{\App\Enums\Status::NotActive}}>
                {{ \App\Enums\Status::NotActive()->description }}
            </option>
        </select>
        <x-jet-input-error for="userCompanyAccess.status" class="mt-2" />
    </div>

    <!-- Emails -->
    <div class="col-span-6 sm:col-span-4">
        <x-jet-label for="user-access-emails" value="{{ __('Additional Emails') }}" />
        <x-jet-input id="user-access-emails" type="text" class="mt-1 block w-full" wire:model="userCompanyAccess.emails" />
        <x-jet-input-error for="userCompanyAccess.emails" class="mt-2" />
    </div>

    <!-- Phone Numbers -->
    <div class="col-span-6 sm:col-span-4">
        <x-jet-label for="user-access-phone_numbers" value="{{ __('Phone Numbers') }}" />
        <x-jet-input id="user-access-phone_numbers" type="text" class="mt-1 block w-full" wire:model="userCompanyAccess.phone_numbers"/>
        <x-jet-input-error for="userCompanyAccess.phone_numbers" class="mt-2" />
    </div>


