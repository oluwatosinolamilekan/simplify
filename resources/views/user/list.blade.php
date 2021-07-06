<x-slot name="header">
    {{ __('Users List') }}
</x-slot>
<div>
    <x-jet-nav-link href="{{route('users.create')}}">+ Add new user</x-jet-nav-link>

    @include('datatables::datatable')
</div>
