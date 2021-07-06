
<div class="mt-5 md:mt-0 md:col-span-2">
    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
        <div class="grid grid-cols-6 gap-6">

            <!-- Ref Code -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="ref_code" value="{{ __('Ref Code') }}" />
                <x-jet-input id="ref_code" type="text" class="mt-1 block w-full" wire:model.defer="factor.ref_code" />
                <x-jet-input-error for="factor.ref_code" class="mt-2" />
            </div>

            <!-- Status -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="status" value="{{ __('Status') }}" />
                <select id="status" wire:model.defer="factor.status" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    <option value="{{\App\Enums\Status::Active}}" @if($factor->status->is(\App\Enums\Status::Active)) selected @endif>
                        {{ \App\Enums\Status::Active()->description }}
                    </option>
                    <option value="{{\App\Enums\Status::NotActive}}" @if($factor->status->is(\App\Enums\Status::NotActive)) selected @endif>
                        {{ \App\Enums\Status::NotActive()->description }}
                    </option>
                </select>
                <x-jet-input-error for="factor.status" class="mt-2" />
            </div>

        </div>
    </div>
</div>
