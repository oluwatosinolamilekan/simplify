<!-- Account deleted -->
<x-jet-dialog-modal wire:model="deleteCompleted">
    <x-slot name="title">
        {{ $title ?? __('Item Deleted') }}
    </x-slot>

    <x-slot name="content">
        {{ $description ?? __('Item successfully deleted.') }}

    </x-slot>

    <x-slot name="footer">
        @foreach($actions ?? [] as $text => $route)
        <a href="{{$route}}" wire:loading.attr="disabled" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition">
            {{ $text ?? __('Back') }}
        </a>
        @endforeach
        <button wire:click="$toggle('deleteCompleted')" wire:loading.attr="disabled" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition">
            {{ __('Close') }}
        </button>
    </x-slot>
</x-jet-dialog-modal>
