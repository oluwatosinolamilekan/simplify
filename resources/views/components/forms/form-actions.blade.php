<div class="flex items-center justify-end px-4 py-3 text-right sm:px-6">

    <x-jet-action-message class="mr-3" on="saved">
        {{ __('Saved.') }}
    </x-jet-action-message>

    <x-jet-button class="text-center xl:mr-3 align-top bg-theme-18 border-theme-18 focus:ring-theme-18" wire:loading.attr="disabled">
        {{ __('Save') }}
    </x-jet-button>

    @if($delete)
        <x-jet-danger-button wire:click="confirmDeletion" class="text-center xl:mr-3 align-top border-theme-18 focus:ring-theme-18" wire:loading.attr="disabled">
            {{ __('Delete') }}
        </x-jet-danger-button>
    @endif
</div>
