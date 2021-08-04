
<div class="mt-5 md:mt-0 md:col-span-2">
    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
        <div class="grid grid-cols-6 gap-6">

            <!-- Name -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" type="text" class="w-1/2 float-right" wire:model="term.name" />
                <x-jet-input-error for="term.name" class="mt-3" />
            </div>

            <!-- Code -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="code" value="{{ __('Code') }}" />
                <x-jet-input id="code" type="text" class="w-1/2 float-right" wire:model="term.code" />
                <x-jet-input-error for="term.code" class="mt-3" />
            </div>

            <!-- Type -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="type" value="{{ __('Type') }}" />
                @php
                    $types = collect(\App\Enums\TermType::getInstances())
                                ->map(fn ($type) => [
                                    'id' => $type->value,
                                    'name' => $type->description ,
                                    'selected' => $term->type->is($type->value)
                                ])
                @endphp
                <x-searchable-select :values="$types" wire:model="term.type"  class="w-1/2 float-right"/>
                <x-jet-input-error for="term.type" class="mt-3" />
            </div>

            <!-- Status -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="status" value="{{ __('Status') }}" />
                @php
                    $statuses = collect([\App\Enums\Status::Active(), \App\Enums\Status::NotActive()])
                                ->map(fn ($status) => [
                                    'id' => $status->value,
                                    'name' => $status->description ,
                                    'selected' => $term->status->is($status->value)
                                ])
                @endphp
                <x-searchable-select :values="$statuses" wire:model="term.status"  class="w-1/2 float-right"/>
                <x-jet-input-error for="term.status" class="mt-3" />
            </div>

        </div>
    </div>
</div>
