
<div class="mt-5 md:mt-0 md:col-span-2">
    <div class="px-4 py-5 bg-white dark:bg-dark-2 sm:p-6 shadow sm:rounded-md">
        <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6 sm:col-span-6">
                <x-jet-label for="client_id" value="{{ __('Client') }}" />
                @php
                    $clients = App\Models\Client::active()
                                ->with('company')
                                ->get()
                                ->map(fn ($client) => [
                                    'id' => $client->id,
                                    'name' => "{$client->ref_code} {$client->company->name}",
                                    'selected' => $client->id == $debtor->client_id
                                ])
                @endphp

                <x-select-option :values="$clients" wire:model="debtor.client_id" class="w-1/2 float-right"/>

                <x-jet-input-error for="debtor.client_id" class="mt-3" />
            </div>
        </div>
    </div>
</div>
