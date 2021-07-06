
<div class="mt-5 md:mt-0 md:col-span-2">
    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
        <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="factor_id" value="{{ __('Factor') }}" />
                <select id="factor_id" wire:model.defer="client.factor_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    @foreach(App\Models\Factor::with('company')->get() as $factor)
                        <option value="{{$factor->id}}" @if($client->factor_id == $factor->id) selected @endif>
                            {{ $factor->ref_code }} {{ $factor->company->name }}
                        </option>
                    @endforeach
                </select>
                <x-jet-input-error for="client.factor_id" class="mt-2" />
            </div>
        </div>
    </div>
</div>
