@if($column['hidden'])
@else
<div class="relative table-cell h-12 overflow-hidden align-top dark:bg-dark-1">
    <button wire:click.prefetch="sort('{{ $index }}')" class="w-full h-full pr-2 pl-2 py-3 border-b border-gray-200 bg-gray-50 dark:bg-dark-1 text-left text-xs leading-4 font-medium text-gray-500 dark:text-white uppercase tracking-wider flex items-center focus:outline-none @if($column['align'] === 'right') flex justify-end @elseif($column['align'] === 'center') flex justify-center @endif">
        <span class="inline table_label dark:text-white">{{ str_replace('_', ' ', $column['label']) }}</span>
        <span class="inline text-xs">
            @if($sort === $index)
            @if($direction)
            <x-icons.chevronup wire:loading.remove/>
            @else
            <x-icons.chevrondown wire:loading.remove/>
            @endif
            @endif
        </span>
    </button>
</div>
@endif
