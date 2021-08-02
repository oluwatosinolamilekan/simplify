<x-slot name="header">
    {{ __('Users List') }}
</x-slot>
<div>
    @include('datatables::datatable', ['table_id' => 'users', 'table_title' => "Users List", 'button_route' => route('users.create'), 'button_id' => "add_new_user", 'button_text' => "Add New User"])
</div>
