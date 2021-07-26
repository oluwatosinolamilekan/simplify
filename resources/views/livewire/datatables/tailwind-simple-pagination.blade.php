<div class="flex justify-between">
<!-- Previous Page Link -->
@if ($paginator->onFirstPage())
<div class="h-8 flex justify-between items-center relative inline-flex items-center px-3 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-400 bg-gray-50 dark:bg-dark-2 dark:text-gray-700">
    <x-icons.arrow-left class="mr-2" />
    Previous
</div>
@else
<button wire:click="previousPage" class="h-8 flex justify-between items-center relative inline-flex items-center px-3 py-2 border border-gray-300 text-sm leading-5 rounded-md text-gray-700 bg-white dark:bg-dark-2 dark:text-gray-400 hover:text-gray-500 focus:outline-none focus:shadow-outline-gray focus:border-gray-300 dark:focus:border-gray-700 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
    <x-icons.arrow-left class="mr-2" />
    Previous
</button>
@endif


<!-- Next Page pnk -->
@if ($paginator->hasMorePages())
<button wire:click="nextPage" class="h-8 flex justify-between items-center relative inline-flex items-center px-3 py-2 border border-gray-300 text-sm leading-5 rounded-md text-gray-700 bg-white dark:bg-dark-2 dark:text-gray-400 hover:text-gray-500 focus:outline-none focus:shadow-outline-gray focus:border-gray-300 dark:focus:border-gray-700 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
    Next
    <x-icons.arrow-right class="ml-2"/>
</button>
@else
<div class="h-8 flex justify-between items-center relative inline-flex items-center px-3 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-400 bg-gray-50 dark:bg-dark-2 dark:text-gray-700">
    Next
    <x-icons.arrow-right class="inline ml-2" />
</div>
@endif
</div>
