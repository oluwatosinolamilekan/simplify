<div class="flex space-x-1 justify-around" id="table_actions_{{ $id }}">
    @if ($view)
    <a href="{{ route($view['route'] ?? $view, $args ?? [$id]) }}" id="datatable_view_icon_{{$id}}" class="p-1 hover:bg-gray-300 dark:hover:bg-dark-2 rounded flex items-center justify-center transition">
        <x-icons.view class="view_icon"/>
    </a>
    @endif

    @if ($update)
    <a href="{{ route($update['route'] ?? $update, $args ?? [$id]) }}" id="datatable_edit_icon_{{$id}}" class="p-1 hover:bg-gray-300 dark:hover:bg-dark-2 rounded transition">
        <x-icons.edit class="edit_icon"/>
    </a>
    @endif

    @if ($delete)
    <button wire:click="confirmItemDeletion({{$id}})" class="p-1 hover:bg-gray-300 dark:hover:bg-dark-2 rounded transition">
        <x-icons.delete/>
    </button>
    @endif
</div>
