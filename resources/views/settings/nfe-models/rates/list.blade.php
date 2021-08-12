

@foreach($this->rates as $index => $rate)
    @php
        $header = $rate->date ?? 'New Rate On Day';
        $collapsed = $rate->id ? 1 : 0;
    @endphp
    <x-collapsible-container :header="$header" :collapsed="$collapsed">
        <x-slot name="form">
            <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
                <div class="grid grid-cols-6 gap-6">
                    @include('settings.nfe-models.rates.form', ['index' => $index])
                </div>
            </div>
        </x-slot>
    </x-collapsible-container>
@endforeach
