
<div class="mt-5 md:mt-0 md:col-span-2">
    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
        <div class="grid grid-cols-6 gap-6">

            <!-- Ref Code -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="ref_code" value="{{ __('Ref Code') }}" />
                <x-jet-input id="ref_code" type="text" class="w-1/2 float-right"  wire:model="vendor.ref_code" />
                <x-jet-input-error for="vendor.ref_code" class="mt-3" />
            </div>

            <!-- Vendor Name -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="name" value="{{ __('Vendor Name') }}" />
                <x-jet-input id="name" type="text" class="w-1/2 float-right" wire:model="vendor.name" />
                <x-jet-input-error for="vendor.name" class="mt-3" />
            </div>

            <!-- Status -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="status" value="{{ __('Status') }}" />
                @php
                    $statuses = collect([\App\Enums\Status::Active(), \App\Enums\Status::NotActive()])
                                ->map(fn ($status) => [
                                    'id' => $status->value,
                                    'name' => $status->description ,
                                    'selected' => $vendor->status->is($status->value)
                                ])
                @endphp
                <x-select-option :values="$statuses" wire:model="vendor.status"  class="w-1/2 float-right"/>
                <x-jet-input-error for="vendor.status" class="mt-3" />
            </div>

        </div>
    </div>
</div>
