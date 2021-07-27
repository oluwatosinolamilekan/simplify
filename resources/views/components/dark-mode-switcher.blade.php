<div data-url="#" class="dark-mode-switcher cursor-pointer shadow-md fixed bottom-0 left-0 box dark:bg-dark-2 border border-gray-200 rounded-full w-40 h-12 flex items-center justify-center z-50 mb-10 ml-10">
    <div class="mr-4 text-gray-700 dark:text-gray-300">Dark Mode</div>
    <a class="dark-mode-switcher__toggle border {{$enabled ? 'dark-mode-switcher__toggle--active' : ''}}" wire:model="enabled" wire:click="toggle"></a>
</div>
