<form wire:submit.prevent="save">
    <x-success-button wire:click="addModel" type="button"> + Add New NFE Model </x-success-button>

    @foreach($models as $index => $model)

        <x-collapsible-container :header="$model->name" :collapsed="$model->id ? 1 : 0">
            <x-slot name="form">
                <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
                    <div class="grid grid-cols-6 gap-6">
                        @include('settings.nfe-models.form', ['index' => $index])
                    </div>
                </div>
            </x-slot>
        </x-collapsible-container>
    @endforeach

    <!-- Actions -->
    @include('components.forms.form-actions', ['delete' => false])

</form>
