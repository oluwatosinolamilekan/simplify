<div>
    @foreach ($users as $user)
        {{ $user->full_name }}
    @endforeach

    {{ $users->links('components.pagination.links') }}
</div>
