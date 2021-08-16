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

        <!-- Term Settings -->
        <div class="mt-10 sm:mt-0">
            <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

                <x-jet-section-title>
                    <x-slot name="title">{{ __('Term Settings') }}</x-slot>
                    <x-slot name="description">{{ __('Configure term values') }}</x-slot>
                </x-jet-section-title>

                <livewire:term.term-settings-form :settings="$settings" :partial="true" :nested="true"/>
            </div>
        </div>

        <x-jet-section-border />

        <!-- Clients -->
        <div class="mt-10 sm:mt-0">
            <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

                <x-jet-section-title>
                    <x-slot name="title">{{ __('Clients') }}</x-slot>
                    <x-slot name="description">{{ __('Assign clients.') }}</x-slot>
                </x-jet-section-title>


                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="px-4 py-5 bg-white dark:bg-dark-2 sm:p-6 shadow sm:rounded-md">
                        <div class="grid grid-cols-6 gap-6">
                            @include('terms.relation.client-form', ['term' => $term])
                            @include('terms.relation.client-list', ['clients' => $clients])
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <x-jet-section-border />

        <!-- Fee Rules -->
        <div class="mt-10 sm:mt-0">
            <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

                <x-jet-section-title>
                    <x-slot name="title">{{ __('Fee Rules') }}</x-slot>
                    <x-slot name="description">{{ __('Assign or update fee rules.') }}</x-slot>
                </x-jet-section-title>


                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="px-4 py-5 bg-white dark:bg-dark-2 sm:p-6 shadow sm:rounded-md">
                        <div class="grid grid-cols-6 gap-6">

                            <!-- Rule type selection -->
                            <!-- TODO: @Sofia or @Lamidi - to be replaced with "Add" button + type selection dropdown -->
                            <div class="col-span-6 sm:col-span-6">
                                <x-jet-label value="{{ __('Fee rule type') }}" />
                                @php
                                    $types = collect(\App\Enums\FeeRuleType::getInstances())
                                                ->map(fn ($type) => [
                                                    'id' => $type->value,
                                                    'name' => $type->description
                                                ])
                                @endphp
                                <x-select-option :values="$types" wire:change="selectFeeRuleType($event.target.value)" class="w-1/2 float-right"/>
                            </div>

                            <div class="col-span-6 sm:col-span-6">

                            @foreach($this->feeRules as $i => $feeRule)
                                @include('terms.fee-rules.form', ['feeRule' => $feeRule, 'index' => $i])
                            @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        @include('components.forms.form-actions', ['delete' => $term->exists])

    </form>

</div>
