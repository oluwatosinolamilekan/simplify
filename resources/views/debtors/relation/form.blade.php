
<div class="mt-5 md:mt-0 md:col-span-2">
    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
        <div class="grid grid-cols-6 gap-6">

            <!-- Ref Code -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="ref_code" value="{{ __('Ref Code') }}" />
                <x-jet-input id="ref_code" type="text" class="w-1/2 float-right"  wire:model="debtor.ref_code" />
                <x-jet-input-error for="debtor.ref_code" class="mt-3" />
            </div>

            <!-- Debtor Name -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="name" value="{{ __('Debtor Name') }}" />
                <x-jet-input id="name" type="text" class="w-1/2 float-right" wire:model="debtor.name" />
                <x-jet-input-error for="debtor.name" class="mt-3" />
            </div>

            <!-- Status -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="status" value="{{ __('Status') }}" />
                @php
                    $statuses = collect([\App\Enums\Status::Active(), \App\Enums\Status::NotActive()])
                                ->map(fn ($status) => [
                                    'id' => $status->value,
                                    'name' => $status->description ,
                                    'selected' => $debtor->status->is($status->value)
                                ])
                @endphp
                <x-select-option :values="$statuses" wire:model="debtor.status"  class="w-1/2 float-right"/>
                <x-jet-input-error for="debtor.status" class="mt-3" />
            </div>

        </div>
    </div>
</div>
