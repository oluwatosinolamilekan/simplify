<div class="pagination flex rounded overflow-hidden">
    <!-- Previous Page Link -->
    @if ($paginator->onFirstPage())
    <button class="relative inline-flex items-center px-2 py-2 bg-white text-sm leading-5 font-medium text-gray-400"
        disabled>
        <span><x-icons.chevronleft/></span>
    </button>
    @else
    <button wire:click="previousPage"
        class="relative inline-flex items-center px-2 py-2 bg-white text-sm leading-5 font-medium text-gray-700 hover:text-gray-400 focus:outline-none focus:z-10 active:text-theme-18 transition ease-in-out duration-150">
        <span><x-icons.chevronleft/></span>
    </button>
    @endif

    <div class="">
        @foreach ($elements as $element)
        @if (is_string($element))
        <button class="-ml-px relative inline-flex items-center px-5 py-2 bg-white text-sm leading-5 font-medium text-gray-700" disabled>
            <span>{{ $element }}</span>
        </button>
        @endif

        <!-- Array Of Links -->

        @if (is_array($element))
        @foreach ($element as $page => $url)
        <button wire:click="gotoPage({{ $page }})"
                class="-mx-1 relative inline-flex items-center px-5 py-2 text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:z-10 active:text-theme-18 transition ease-in-out duration-150 {{ $page === $paginator->currentPage() ? 'text-theme-18' : 'bg-white' }}">
            {{ $page }}
            </button>
        @endforeach
        @endif
        @endforeach
    </div>

    <!-- Next Page Link -->
    @if ($paginator->hasMorePages())
    <button wire:click="nextPage"
        class="-ml-px relative inline-flex items-center px-2 py-2 bg-white text-sm leading-5 font-medium text-gray-700 hover:text-gray-400 focus:outline-none focus:z-10 active:text-theme-18 transition ease-in-out duration-150">
        <span><x-icons.chevronright/></span>
    </button>
    @else
    <button
        class="-ml-px relative inline-flex items-center px-2 py-2 bg-white text-sm leading-5 font-medium text-gray-400 "
        disabled><span><x-icons.chevronright/></span></button>
    @endif
</div>
