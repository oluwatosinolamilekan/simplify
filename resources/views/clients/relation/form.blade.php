
<div class="mt-5 md:mt-0 md:col-span-2">
    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
        <div class="grid grid-cols-6 gap-6">

            <!-- Ref Code -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="ref_code" value="{{ __('Ref Code') }}" />
                <x-jet-input id="ref_code" type="text" class="w-1/2 float-right"  wire:model="client.ref_code" />
                <x-jet-input-error for="client.ref_code" class="mt-3" />
            </div>

            <!-- Client Name -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="name" value="{{ __('Client Name') }}" />
                <x-jet-input id="name" type="text" class="w-1/2 float-right" wire:model="client.name" />
                <x-jet-input-error for="client.name" class="mt-3" />
            </div>

            <!-- Office -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="office" value="{{ __('Office') }}" />
                <x-jet-input id="office" type="text" class="w-1/2 float-right" wire:model="client.office" />
                <x-jet-input-error for="client.office" class="mt-3" />
            </div>

            <!-- Type -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="type" value="{{ __('Type') }}" />
                @php
                    $types = collect(\App\Enums\ClientType::getInstances())
                                ->map(fn ($type) => [
                                    'id' => $type->value,
                                    'name' => $type->description,
                                    'selected' => $client->type === $type
                                ])
                @endphp
                <x-select-option :values="$types" wire:model="client.type"  class="w-1/2 float-right"/>
                <x-jet-input-error for="client.type" class="mt-3" />
            </div>



            <!-- Status -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="status" value="{{ __('Status') }}" />
                @php
                    $statuses = collect(\App\Enums\StatusTypesList::Client)
                                ->map(fn ($status) => [
                                    'id' => $status,
                                    'name' => \App\Enums\Status::fromValue($status)->description ,
                                    'selected' => $client->status === $status
                                ])
                @endphp
                <x-select-option :values="$statuses" wire:model="client.status"  class="w-1/2 float-right"/>
                <x-jet-input-error for="client.status" class="mt-3" />
            </div>

        </div>
    </div>
</div>
