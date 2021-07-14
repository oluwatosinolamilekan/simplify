<!-- Delete User Confirmation Modal -->
<x-jet-dialog-modal wire:model="confirmingDeletion">
    <x-slot name="title">
        {{ $title ?? __('Delete Item') }}
    </x-slot>

    <x-slot name="content">
        {{ $description ?? __('Are you sure you want to delete this item? Once it is deleted, all of its resources and data will be permanently deleted.') }}

    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="cancelDeletion" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-jet-danger-button class="ml-2" wire:click="deleteModel({{$model ?? null}})" wire:loading.attr="disabled">
            {{ __('Delete') }}
        </x-jet-danger-button>
    </x-slot>
</x-jet-dialog-modal>

