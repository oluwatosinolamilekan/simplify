
<div class="mt-5 md:mt-0 md:col-span-2">
    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
        <div class="grid grid-cols-6 gap-6">

            <!-- Ref Code -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="ref_code" value="{{ __('Ref Code') }}" />
                <x-jet-input id="ref_code" type="text" class="mt-1 block w-full" wire:model="factor.ref_code" />
                <x-jet-input-error for="factor.ref_code" class="mt-3" />
            </div>

            <!-- Status -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="factor-status" value="{{ __('Status') }}" />
                @php
                    $statuses = collect(\App\Enums\StatusTypesList::Client)
                                   ->map(fn ($status) => [
                                       'id' => $status,
                                       'name' => \App\Enums\Status::fromValue($status)->description ,
                                       'selected' => $factor->status === $status
                                   ])
                @endphp
                <x-select-option :values="$statuses" wire:model="factor.status"  class=""/>
                <x-jet-input-error for="factor.status" class="mt-3" />
            </div>

        </div>
    </div>
</div>
