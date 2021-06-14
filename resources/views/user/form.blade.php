<div class="flex">
    <x-sidebar/>
    <!-- BEGIN: Content -->
    <div class="content">
        <x-topbar/>
        <x-jet-form-section submit="save" class="mt-6">
            <x-slot name="title">
                @if($user->exists) {{__('Update')}} @else {{ __('Create') }} @endif {{ __(' User Account') }}
            </x-slot>

            <x-slot name="description">
                {{ __('Fill account\'s profile information and email address.') }}
            </x-slot>

            <x-slot name="form">
                <!-- First Name -->
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="first_name" value="{{ __('First Name') }}" />
                    <x-jet-input id="first_name" type="text" class="mt-1 block w-full" wire:model.defer="user.first_name" autocomplete="name" />
                    <x-jet-input-error for="user.first_name" class="mt-2" />
                </div>

                <!-- Last Name -->
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="last_name" value="{{ __('Last Name') }}" />
                    <x-jet-input id="last_name" type="text" class="mt-1 block w-full" wire:model.defer="user.last_name" autocomplete="name" />
                    <x-jet-input-error for="user.last_name" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="user.email"/>
                    <x-jet-input-error for="user.email" class="mt-2" />
                </div>

                <!-- Role -->
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="role" value="{{ __('Role') }}" />
                    <select id="role" wire:model.defer="user.role" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        <option value="">Select Role</option>
                        @foreach(\App\Enums\Role::getInstances() as $role)
                            <option value={{$role->value}}>
                                {{ $role->description }}
                            </option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="user.role" class="mt-2" />
                </div>
            </x-slot>

            <!-- Actions -->
            <x-slot name="actions">

                <x-jet-action-message class="mr-3" on="saved">
                    {{ __('Saved.') }}
                </x-jet-action-message>

                <x-jet-button class="text-center xl:mr-3 align-top bg-theme-18 border-theme-18 focus:ring-theme-18" wire:loading.attr="disabled">
                    {{ __('Save') }}
                </x-jet-button>

                @if($user->exists)
                    <x-jet-danger-button wire:click="confirmDeletion" class="text-center xl:mr-3 align-top border-theme-18 focus:ring-theme-18" wire:loading.attr="disabled">
                        {{ __('Delete') }}
                    </x-jet-danger-button>

                    <!-- Delete User Confirmation Modal -->
                    <x-dialogs.delete-confirmation>
                        <x-slot name="title">Delete Account</x-slot>
                        <x-slot name="description">Are you sure you want to delete user's account? Once it is deleted, all of its resources and data will be permanently deleted.</x-slot>
                    </x-dialogs.delete-confirmation>

                    <!-- Delete Completed Modal -->
                    <x-dialogs.delete-completed :actions="['users.list' => 'Back To Users List']">
                        <x-slot name="title">Account Deleted</x-slot>
                        <x-slot name="description">Account successfully deleted.</x-slot>
                    </x-dialogs.delete-completed>
                @endif
            </x-slot>
        </x-jet-form-section>
    </div>
</div>
