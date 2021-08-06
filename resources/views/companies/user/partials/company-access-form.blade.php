
    <!-- First Name -->
    <div class="col-span-6 sm:col-span-3">
        <x-jet-label for="first_name" value="{{ __('First Name') }}" />
        <x-jet-input id="first_name" type="text" class="mt-1 block w-full" wire:model="userCompanyAccess.first_name" autocomplete="given-name" />
        <x-jet-input-error for="userCompanyAccess.first_name" class="mt-3" />
    </div>

    <!-- Last Name -->
    <div class="col-span-6 sm:col-span-3">
        <x-jet-label for="last_name" value="{{ __('Last Name') }}" />
        <x-jet-input id="last_name" type="text" class="mt-1 block w-full" wire:model="userCompanyAccess.last_name" autocomplete="family-name" />
        <x-jet-input-error for="userCompanyAccess.last_name" class="mt-3" />
    </div>

    <!-- Middle Name -->
    <div class="col-span-6 sm:col-span-4">
        <x-jet-label for="middle_name" value="{{ __('Middle Name') }}" />
        <x-jet-input id="middle_name" type="text" class="mt-1 block w-full" wire:model="userCompanyAccess.middle_name" autocomplete="additional-name" />
        <x-jet-input-error for="userCompanyAccess.middle_name" class="mt-3" />
    </div>

    <!-- Role -->
    <div class="col-span-6 sm:col-span-3">
        <x-jet-label for="role" value="{{ __('Role') }}" />
        @php
            $roles = collect(\App\Enums\RoleTypesList::Company)
                        ->map(fn ($role) => [
                            'id' => $role,
                            'name' => \App\Enums\Role::fromValue($role)->description ,
                            'selected' => $role === $userCompanyAccess->role->value
                        ])
        @endphp
        <x-searchable :values="$roles" wire:model="userCompanyAccess.role"/>

        <x-jet-input-error for="userCompanyAccess.role" class="mt-3" />
    </div>

    <!-- Status -->
    <div class="col-span-6 sm:col-span-3">
        <x-jet-label for="user-access-status" value="{{ __('Status') }}" />
        @php
            $statuses = collect(\App\Enums\StatusTypesList::UserCompanyAccess)
                        ->map(fn ($status) => [
                            'id' => $status,
                            'name' => \App\Enums\Status::fromValue($status)->description ,
                            'selected' => $userCompanyAccess->status === $status
                        ])
        @endphp
        <x-searchable :values="$statuses" wire:model="userCompanyAccess.status"/>
        <x-jet-input-error for="userCompanyAccess.status" class="mt-3" />
    </div>

    <!-- Emails -->
    <div class="col-span-6 sm:col-span-3">
        <x-jet-label for="user-access-emails" value="{{ __('Additional Emails') }}" />
        <x-jet-input id="user-access-emails" type="text" class="mt-1 block w-full" wire:model="userCompanyAccess.emails" />
        <x-jet-input-error for="userCompanyAccess.emails" class="mt-3" />
    </div>

    <!-- Phone Numbers -->
    <div class="col-span-6 sm:col-span-3">
        <x-jet-label for="user-access-phone_numbers" value="{{ __('Phone Numbers') }}" />
        <x-jet-input id="user-access-phone_numbers" type="text" class="mt-1 block w-full" wire:model="userCompanyAccess.phone_numbers"/>
        <x-jet-input-error for="userCompanyAccess.phone_numbers" class="mt-3" />
    </div>


