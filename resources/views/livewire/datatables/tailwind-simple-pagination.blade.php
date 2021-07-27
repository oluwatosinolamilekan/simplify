<div class="flex justify-between">
<!-- Previous Page Link -->
@if ($paginator->onFirstPage())
<x-sample-pagination-button class="text-gray-400 bg-gray-50 dark:text-gray-700">
    <x-icons.arrow-left class="mr-2" />
    Previous
</x-sample-pagination-button>
@else
<x-sample-pagination-button wire:click="previousPage" class="text-gray-700 bg-white dark:text-gray-400 hover:text-gray-500 active:bg-gray-100 active:text-gray-700">
    <x-icons.arrow-left class="mr-2" />
    Previous
</x-sample-pagination-button>
@endif


<!-- Next Page pnk -->
@if ($paginator->hasMorePages())
<x-sample-pagination-button wire:click="nextPage" class="text-gray-700 bg-white dark:text-gray-400 hover:text-gray-500 active:bg-gray-100 active:text-gray-700">
    Next
    <x-icons.arrow-right class="ml-2"/>
</x-sample-pagination-button>
@else
<x-sample-pagination-button class="text-gray-400 bg-gray-50 dark:text-gray-700">
    Next
    <x-icons.arrow-right class="inline ml-2" />
</x-sample-pagination-button>
@endif
</div>
