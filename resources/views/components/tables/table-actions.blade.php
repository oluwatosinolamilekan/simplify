<div class="flex space-x-1 justify-around">
    @if ($view)
    <a href="{{ route($view['route'] ?? $view, $args ?? [$id]) }}" class="p-1 hover:bg-gray-300 dark:hover:bg-dark-2 rounded flex items-center justify-center transition">
        <x-icons.view stroke="{{ Auth::user()->preferences['dark_mode'] == 'true' ? '#a0aec0' : '#4A5568'}}"/>
    </a>
    @endif

    @if ($update)
    <a href="{{ route($update['route'] ?? $update, $args ?? [$id]) }}" class="p-1 hover:bg-gray-300 dark:hover:bg-dark-2 rounded transition">
        <x-icons.edit stroke="{{ Auth::user()->preferences['dark_mode'] == 'true' ? '#a0aec0' : '#2D3748'}}"/>
    </a>
    @endif

    @if ($delete)
    <button wire:click="confirmItemDeletion({{$id}})" class="p-1 hover:bg-gray-300 dark:hover:bg-dark-2 rounded transition">
        <x-icons.delete/>
    </button>
    @endif
</div>
