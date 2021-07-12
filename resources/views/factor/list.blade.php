<x-slot name="header">
    {{ __('Factors List') }}
</x-slot>
<div>
    <x-jet-nav-link href="{{route('factors.create')}}" id="add_new_factor">+ Add new factor</x-jet-nav-link>

    @include('datatables::datatable')

    <x-dialogs.delete-confirmation>
        <x-slot name="title">Delete Factor</x-slot>
        <x-slot name="description">Are you sure you want to delete factor? Once it is deleted, all of its resources and data will be permanently deleted.</x-slot>
    </x-dialogs.delete-confirmation>

    <!-- Delete Completed Modal -->
    <x-dialogs.delete-completed>
        <x-slot name="title">Factor Deleted</x-slot>
        <x-slot name="description">Factor successfully deleted.</x-slot>
    </x-dialogs.delete-completed>
</div>
