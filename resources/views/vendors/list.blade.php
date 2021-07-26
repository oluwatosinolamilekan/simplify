<x-slot name="header">
    {{ __('Vendors List') }}
</x-slot>
<div>
    <x-jet-nav-link href="{{route('vendors.create')}}">+ Add new vendor</x-jet-nav-link>

    @include('datatables::datatable')
</div>
