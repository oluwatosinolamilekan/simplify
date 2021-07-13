
<div class="mt-5 md:mt-0 md:col-span-2">
    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
        <div class="grid grid-cols-6 gap-6">

            <!-- Ref Code -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="ref_code" value="{{ __('Ref Code') }}" />
                <x-jet-input id="ref_code" type="text" class="w-1/2 float-right"  wire:model="client.ref_code" />
                <x-jet-input-error for="client.ref_code" class="mt-2" />
            </div>

            <!-- Client Name -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="name" value="{{ __('Client Name') }}" />
                <x-jet-input id="name" type="text" class="w-1/2 float-right" wire:model="client.name" />
                <x-jet-input-error for="client.name" class="mt-2" />
            </div>

            <!-- Client Name -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="office" value="{{ __('Office') }}" />
                <x-jet-input id="office" type="text" class="w-1/2 float-right" wire:model="client.office" />
                <x-jet-input-error for="client.office" class="mt-2" />
            </div>

            <!-- Type -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="type" value="{{ __('Type') }}" />
                <x-forms.select id="type" wire:model="client.type" class="w-1/2 float-right">
                    @foreach(\App\Enums\ClientType::getInstances() as $type)
                        <option value="{{$type->value}}" @if($client->type->is($type->value)) selected @endif>
                            {{ $type->description }}
                        </option>
                    @endforeach
                </x-forms.select>
                <x-jet-input-error for="client.type" class="mt-2" />
            </div>

            <!-- Status -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="status" value="{{ __('Status') }}" />
                <x-forms.select id="status" wire:model="client.status" class="w-1/2 float-right">
                    <option value="{{\App\Enums\Status::Active}}" @if($client->status->is(\App\Enums\Status::Active)) selected @endif>
                        {{ \App\Enums\Status::Active()->description }}
                    </option>
                    <option value="{{\App\Enums\Status::NotActive}}" @if($client->status->is(\App\Enums\Status::NotActive)) selected @endif>
                        {{ \App\Enums\Status::NotActive()->description }}
                    </option>
                </x-forms.select>
                <x-jet-input-error for="client.status" class="mt-2" />
            </div>

        </div>
    </div>
</div>
