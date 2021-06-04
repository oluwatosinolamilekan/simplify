<x-livewire-tables::table.cell class="hidden md:table-cell">
    <div>
        <span class="badge badge-default">{{ ucfirst($row->type) }}</span>
    </div>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <div class="flex items-center">
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div wire:key="profile-picture-{{ $row->id }}" class="flex-shrink-0 h-10 w-10">
                <img class="h-10 w-10 rounded-full" src="{{ $row->profile_photo_url }}" alt="{{ $row->name }}" />
            </div>
        @endif

        <div class="@if (Laravel\Jetstream\Jetstream::managesProfilePhotos()) ml-4 @endif">
            <div class="text-sm font-medium text-gray-900">
                {{ $row->name }}
            </div>

            @if($row->timezone)
                <div wire:key="timezone-{{ $row->id }}" class="text-sm text-gray-500">
                    {{ str_replace('_', ' ', $row->timezone) }}
                </div>
            @endif
        </div>
    </div>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <p class="text-blue-400 truncate">
        <a href="mailto:{{ $row->email }}" class="hover:underline">{{ $row->email }}</a>
    </p>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell class="hidden md:table-cell">
    <div>
        @if ($row->isActive())
            <span class="badge badge-success">@lang('Yes')</span>
        @else
            <span class="badge badge-danger">@lang('No')</span>
        @endif
    </div>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell class="hidden md:table-cell">
    <div>
        @if ($row->isVerified())
            <span class="badge badge-success">@lang('Yes')</span>
        @else
            <span class="badge badge-danger">@lang('No')</span>
        @endif
    </div>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell class="hidden md:table-cell">
    <div>
        @if ($row->twoFactorEnabled())
            <span class="badge badge-success">@lang('Enabled')</span>
        @else
            <span class="badge badge-danger">@lang('Disabled')</span>
        @endif
    </div>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <a href="#" wire:click.prevent="manage({{ $row->id }})" class="text-primary-600 font-medium hover:text-primary-900">Manage</a>
</x-livewire-tables::table.cell>
