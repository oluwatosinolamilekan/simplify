
<div class="mt-5 md:mt-0 md:col-span-2">
    <div class="px-4 py-5 bg-white dark:bg-dark-2 sm:p-6 shadow sm:rounded-md">
        <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6 sm:col-span-6">
                <x-jet-label for="factor_id" value="{{ __('Factor') }}" />
                @php
                    $factors = App\Models\Factor::active()
                                ->with('company')
                                ->get()
                                ->map(fn ($factor) => [
                                    'value' => $factor->id,
                                    'description' => "{$factor->ref_code} {$factor->company->name}"
                                ])
                @endphp

                <livewire:select-searchable :selectOptions="$factors" :wire="'client.factor_id'" :value="$client->factor_id" class="w-1/2 float-right"/>

                <x-jet-input-error for="client.factor_id" class="mt-3" />
            </div>
        </div>
    </div>
</div>
