<div class="pagination flex rounded overflow-hidden">
    <!-- Previous Page Link -->
    @if ($paginator->onFirstPage())
    <x-pagination-button disabled>
        <span><x-icons.chevronleft/></span>
    </x-pagination-button>
    @else
    <x-pagination-button wire:click="previousPage"
        class="text-gray-700 hover:text-gray-400 focus:outline-none focus:z-10 active:text-theme-18">
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
                class="-mx-1 px-5 text-gray-700 hover:text-gray-500 focus:outline-none focus:z-10 active:text-theme-18 {{ $page === $paginator->currentPage() ? 'text-theme-18' : 'bg-white' }}">
            {{ $page }}
            </x-pagination-button>
        @endforeach
        @endif
        @endforeach
    </div>

    <!-- Next Page Link -->
    @if ($paginator->hasMorePages())
    <x-pagination-button wire:click="nextPage"
        class="-ml-px text-gray-700 hover:text-gray-400 focus:outline-none focus:z-10 active:text-theme-18">
        <span><x-icons.chevronright/></span>
    </x-pagination-button>
    @else
    <x-pagination-button disabled>
        <span><x-icons.chevronright/></span>
    </x-pagination-button>
    @endif
</div>
