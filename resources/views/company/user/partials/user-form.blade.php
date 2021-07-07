
<!-- Email -->

<div class="col-span-6 sm:col-span-3">
    <x-jet-label for="email" value="{{ __('Email') }}" />
    <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="user.email" autocomplete="email" :disabled="$this->user->exists"/>
    <x-jet-input-error for="user.email" class="mt-2" />
</div>
