<x-slot name="header">
    {{ __('Clients List') }}
</x-slot>
<div>
    <x-jet-nav-link href="{{route('clients.create')}}">+ Add new client</x-jet-nav-link>

    @include('datatables::datatable')
</div>
