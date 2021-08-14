
    <div class="col-span-6 sm:col-span-6">
        <x-jet-label for="client" value="{{ __('Assign Client') }}" />
        @php
            $clients = $this->clientOptions()->map(fn ($client) => [
                'value' => $client->id,
                'description' => "{$client->ref_code} {$client->company->name}"
            ]);
        @endphp
        <livewire:select-searchable :selectOptions="$clients" :wire="$client_id" :value="$client_id" class="w-1/2 float-right"/>
    </div>
