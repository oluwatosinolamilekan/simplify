<x-slot name="header">
    {{ __('Debtors List') }}
</x-slot>
<div>
    <x-jet-nav-link href="{{route('debtors.create')}}">+ Add new debtor</x-jet-nav-link>

    @include('datatables::datatable')
</div>
