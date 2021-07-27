<div class="pagination flex rounded overflow-hidden">
    <!-- Previous Page Link -->
    @if ($paginator->onFirstPage())
    <x-pagination-button disabled class="dark:text-gray-700">
        <span><x-icons.chevronleft/></span>
    </x-pagination-button>
    @else
    <x-pagination-button wire:click="previousPage"
        class="text-gray-700 hover:text-gray-400 active:text-theme-18 dark:text-gray-500 dark:hover:text-white">
        <span><x-icons.chevronleft/></span>
    </x-pagination-button>
    @endif

    <div class="">
        @foreach ($elements as $element)
        @if (is_string($element))
        <x-pagination-button class="px-5 text-gray-700" disabled>
            <span>{{ $element }}</span>
        </x-pagination-button>
        @endif

        <!-- Array Of Links -->

        @if (is_array($element))
        @foreach ($element as $page => $url)
        <x-pagination-button wire:click="gotoPage({{ $page }})"
                class="-mx-1 px-5 hover:text-gray-500 active:text-theme-18 dark:hover:text-white {{ $page === $paginator->currentPage() ? 'text-theme-18 dark:text-theme-18' : 'dark:text-gray-400 text-gray-700' }}">
            {{ $page }}
            </x-pagination-button>
        @endforeach
        @endif
        @endforeach
    </div>

    <!-- Next Page Link -->
    @if ($paginator->hasMorePages())
    <x-pagination-button wire:click="nextPage"
        class="-ml-px text-gray-700 hover:text-gray-400 active:text-theme-18 dark:text-gray-500 dark:hover:text-white">
        <span><x-icons.chevronright/></span>
    </x-pagination-button>
    @else
    <x-pagination-button disabled class="dark:text-gray-700">
        <span><x-icons.chevronright/></span>
    </x-pagination-button>
    @endif
</div>
