<x-slot name="header">
    {{ __('Users List') }}
</x-slot>
<div class="">
    <div class="inline-block w-full my-4">
        {{--<span class="text-xl font-medium mt-auto mb-auto">Table Title Here</span>--}}
        <x-success-anchor href="{{route('users.create')}}" id="add_new_user" class="mr-0 normal_letter_spacing float-right">Add New User</x-success-anchor>
    </div>
    @include('datatables::datatable')
</div>
