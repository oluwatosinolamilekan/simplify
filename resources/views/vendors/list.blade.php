<x-slot name="header">
    {{ __('Vendors List') }}
</x-slot>
<div>
    @include('datatables::datatable', ['button_route' => route('vendors.create'), 'button_id' => "add_new_vendor", 'button_text' => "Add New Vendor"])
</div>
