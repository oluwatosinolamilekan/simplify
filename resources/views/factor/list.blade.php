<x-slot name="header">
    {{ __('Factors List') }}
</x-slot>
<div>
    <x-jet-nav-link href="{{route('factors.create')}}" id="add_new_factor">+ Add new factor</x-jet-nav-link>

    @include('datatables::datatable')
</div>
