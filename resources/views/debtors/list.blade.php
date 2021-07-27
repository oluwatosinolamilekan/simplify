<x-slot name="header">
    {{ __('Debtors List') }}
</x-slot>
<div>
    @include('datatables::datatable', ['table_title' => 'Debtors List', 'button_route' => route('debtors.create'), 'button_id' => "add_new_debtor", 'button_text' => "Add New debtor"])
</div>
