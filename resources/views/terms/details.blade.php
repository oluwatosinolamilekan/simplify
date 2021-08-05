<x-slot name="header">
    {{ __('Term Details') }}
</x-slot>

<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <!-- Term Information -->
    <div class="mt-10 sm:mt-0">
        <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

            <x-jet-section-title>
                <x-slot name="title">{{ __('Term Information') }}</x-slot>
                <x-slot name="description">{{ __('Term basic details')}}</x-slot>
            </x-jet-section-title>

            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
                    <div class="grid grid-cols-6 gap-6">

                        <!-- Code -->
                        <div class="col-span-6 sm:col-span-3">
                            <x-jet-label for="ref_code" value="{{ __('Code') }}" />
                            <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                {{ $term->code }}
                            </span>
                        </div>

                        <!-- Name -->
                        <div class="col-span-6 sm:col-span-3">
                            <x-jet-label for="name" value="{{ __('Name') }}" />
                            <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                {{ $term->name }}
                            </span>
                        </div>

                        <!-- Status -->
                        <div class="col-span-6 sm:col-span-3">
                            <x-jet-label for="status" value="{{ __('Status') }}" />
                            @if($term->status->is(\App\Enums\Status::Active))
                                <x-icons.check-circle class="text-green-600 mx-0 inline" />
                            @else
                                <x-icons.x-circle class="text-red-300 mx-0 inline" />
                            @endif
                            <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                {{$term->status->description}}
                            </span>
                        </div>

                        <!-- Type -->
                        <div class="col-span-6 sm:col-span-3">
                            <x-jet-label for="type" value="{{ __('Type') }}" />
                            <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                {{$term->type->description}}
                            </span>
                        </div>

                        <!-- Factor -->
                        <div class="col-span-6 sm:col-span-3">
                            <x-jet-label for="factor" value="{{ __('Factor') }}" />
                            <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                {{ $term->factor->ref_code }} {{ $term->factor->company->name }}
                            </span>
                        </div>


                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Term Settings -->
    <div class="mt-10 sm:mt-0">
        <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">
            <x-jet-section-title>
                <x-slot name="title">{{ __('Term Settings') }}</x-slot>
                <x-slot name="description">{{ __('Term configuration')}}</x-slot>
            </x-jet-section-title>
            @include('terms.settings.details', ['settings' => $term->settings])
        </div>
    </div>

    <!-- Clients Information -->
    <div class="mt-10 sm:mt-0">
        <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">
            <x-jet-section-title>
                <x-slot name="title">{{ __('Assigned Clients') }}</x-slot>
                <x-slot name="description">{{ __('Clients assigned to this term')}}</x-slot>
            </x-jet-section-title>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
                    @foreach($term->clients as $client)
                        <span class="text-wrap mx-2 py-3 sm:inline-block w-5/6">{{$client->ref_code}} {{$client->company->name}}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Fee Rules Information -->
    <div class="mt-10 sm:mt-0">
        <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">
            <x-jet-section-title>
                <x-slot name="title">{{ __('Fee Rules') }}</x-slot>
                <x-slot name="description">{{ __('Fee rules and configurations')}}</x-slot>
            </x-jet-section-title>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
                    @foreach($term->feeRules as $feeRule)
                        @include('terms.fee-rules.details', ['feeRule' => $feeRule])
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6">

        <x-success-anchor href="{{route('terms.update', $this->term->id)}}">
            {{ __('Update') }}
        </x-success-anchor>

        <x-danger-button wire:click="confirmDeletion" wire:loading.attr="disabled">
            {{ __('Delete') }}
        </x-danger-button>
    </div>
</div>

