<x-slot name="header">
    {{ __('Factors List') }}
</x-slot>
<div>
    @include('datatables::datatable', ['table_title' => "Factors List", 'button_route' => route('factors.create'), 'button_id' => "add_new_factor", 'button_text' => "Add New Factor"])
</div>
