<x-slot name="header">
    {{ __('Users List') }}
</x-slot>
<div>
    <x-jet-nav-link href="{{route('users.create')}}" id="add_new_user">+ Add new user</x-jet-nav-link>

    @include('datatables::datatable')

    <x-dialogs.delete-confirmation>
        <x-slot name="title">Delete Account</x-slot>
        <x-slot name="description">Are you sure you want to delete user's account? Once it is deleted, all of its resources and data will be permanently deleted.</x-slot>
    </x-dialogs.delete-confirmation>

    <!-- Delete Completed Modal -->
    <x-dialogs.delete-completed>
        <x-slot name="title">Account Deleted</x-slot>
        <x-slot name="description">Account successfully deleted.</x-slot>
    </x-dialogs.delete-completed>
</div>
