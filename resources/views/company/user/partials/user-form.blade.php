
<!-- Email -->
<div class="col-span-6 sm:col-span-3">
    <x-jet-label for="email" value="{{ __('Email') }}" />
    <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.debounce.2s="user.email" autocomplete="email" :disabled="!$editable"/>
    <x-jet-input-error for="user.email" class="mt-3" />
</div>
