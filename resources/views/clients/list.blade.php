<x-slot name="header">
    {{ __('Clients List') }}
</x-slot>
<div>
    @include('datatables::datatable', ['table_title' => "Clients List", 'button_route' => route('clients.create'), 'button_id' => "add_new_client", 'button_text' => "Add New Client"])
</div>
