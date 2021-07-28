<x-slot name="header">
    {{ __('Term Wizard') }}
</x-slot>


<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

    <form wire:submit.prevent="save">

        <!-- Term Information -->
        <div class="mt-10 sm:mt-0">
            <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

                <x-jet-section-title>
                    <x-slot name="title">{{ __('Term Information') }}</x-slot>
                    <x-slot name="description">{{ __('Fill term information.') }}</x-slot>
                </x-jet-section-title>

                @include('terms.form', ['term' => $term])
            </div>
        </div>

        <x-jet-section-border />

        <!-- Factor Information -->
        <div class="mt-10 sm:mt-0">
            <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

                <x-jet-section-title>
                    <x-slot name="title">{{ __('Factor Information') }}</x-slot>
                    <x-slot name="description">{{ __('Select factor.') }}</x-slot>
                </x-jet-section-title>

                @include('terms.relation.factor-form', ['term' => $term])
            </div>
        </div>

        <x-jet-section-border />

        <!-- Actions -->
        @include('components.forms.form-actions', ['delete' => $term->exists])

    </form>

</div>
