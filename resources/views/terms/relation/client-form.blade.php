
    <div class="col-span-6 sm:col-span-6">
        <x-jet-label for="client" value="{{ __('Assign Client') }}" />
        @php
            $clients = $this->clientOptions()->map(fn ($client) => [
                'value' => $client->id,
                'description' => "{$client->ref_code} {$client->company->name}"
            ]);
        @endphp
        <livewire:onchange-select :selectOptions="$clients" class="" :selected="selectedItem($event.target.value)"/>
{{--        <x-select-option :values="$clients" wire:change="assignClient($event.target.value)" class="w-1/2 float-right" id="client"/>--}}
    </div>
