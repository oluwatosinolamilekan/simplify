<x-slot name="header">
    {{ __('Terms List') }}
</x-slot>
<div>
    @include('datatables::datatable', ['table_title' => 'Terms List', 'button_route' => route('terms.create'), 'button_id' => "add_new_term", 'button_text' => "Add New Term"])
</div>
