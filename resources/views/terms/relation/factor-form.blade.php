
<div class="mt-5 md:mt-0 md:col-span-2">
    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
        <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6 sm:col-span-6">
                <x-jet-label for="factor_id" value="{{ __('Factor') }}" />
                @php
                    $factors = App\Models\Factor::active()
                                ->with('company')
                                ->get()
                                ->map(fn ($factor) => [
                                    'id' => $factor->id,
                                    'name' => "{$factor->ref_code} {$factor->company->name}",
                                    'selected' => $factor->id == $term->factor_id
                                ])
                @endphp

                <x-select-option :values="$factors" wire:model="term.factor_id" class="w-1/2 float-right"/>

                <x-jet-input-error for="term.factor_id" class="mt-3" />
            </div>
        </div>
    </div>
</div>
