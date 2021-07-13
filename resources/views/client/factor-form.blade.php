
<div class="mt-5 md:mt-0 md:col-span-2">
    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
        <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6 sm:col-span-6">
                {{ $client->factor_id }}
                <x-jet-label for="factor_id" value="{{ __('Factor') }}" />
                <x-forms.select id="factor_id" wire:model.defer="client.factor_id" class="w-1/2 float-right">
                    @foreach(App\Models\Factor::with('company')->get() as $factor)
                        <option value="{{$factor->id}}">
                            {{ $factor->ref_code }} {{ $factor->company->name }} {{$client->factor_id == $factor->id}}
                        </option>
                    @endforeach
                </x-forms.select>
                <x-jet-input-error for="client.factor_id" class="mt-2" />
            </div>
        </div>
    </div>
</div>
