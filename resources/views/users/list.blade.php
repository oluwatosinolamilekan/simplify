<x-slot name="header">
    {{ __('Users List') }}
</x-slot>
<div class="">
    <div class="flex justify-between my-4">
        <span class="text-xl font-medium mt-auto mb-auto">3 Peaks Logistics</span>
        <x-success-anchor href="{{route('users.create')}}" id="add_new_user" class="mr-0 normal_letter_spacing">Add New User</x-success-anchor>
    </div>
    @include('datatables::datatable')
</div>
