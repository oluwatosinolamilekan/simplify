
    <div class="col-span-6 sm:col-span-6">
        <x-jet-label for="client" value="{{ __('Assign Client') }}" />
        @php
            $clients = $this->clientOptions()->mapWithKeys(function ($client){
               return [$client->id => "{$client->ref_code} {$client->company->name}"];
            });
        @endphp
        <x-list :data="$clients"  multiple/>
{{--        <x-select-option :values="$clients" wire:change="assignClient($event.target.value)" class="w-1/2 float-right" id="client"/>--}}
    </div>
