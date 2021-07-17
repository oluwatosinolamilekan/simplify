<div class="flex space-x-1 justify-around">
    @if ($view)
    <a href="{{ route($view['route'] ?? $view, $args ?? [$id]) }}" class="p-1 hover:bg-gray-300 rounded flex items-center justify-center">
        <x-icons.view/>
    </a>
    @endif

    @if ($update)
    <a href="{{ route($update['route'] ?? $update, $args ?? [$id]) }}" class="p-1 hover:bg-gray-300 rounded">
        <x-icons.edit/>
    </a>
    @endif

    @if ($delete)
    <button wire:click="confirmItemDeletion({{$id}})" class="p-1 hover:bg-gray-300 rounded">
        <x-icons.delete/>
    </button>
    @endif
</div>
