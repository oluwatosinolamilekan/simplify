<x-slot name="header">
    {{ __('Factor Wizard') }}
</x-slot>
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

        <!-- Company Information -->
        <div class="mt-10 sm:mt-0">
            <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">
                @include('company.details', ['company' => $factor->company, 'title' => __('Company Information'), 'description' => __('Company Basic Information.')])

            </div>
        </div>

        <x-jet-section-border />

        <!-- Factor Information -->
        <div class="mt-10 sm:mt-0">
            <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">
                @include('factor.relation-details', ['company' => $factor->company, 'title' => __('Factor Information'), 'description' => __('Factor Basic Information.')])
            </div>
        </div>

        <x-jet-section-border />

        <!-- Bank Information -->
        <div class="mt-10 sm:mt-0">
            <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">
                @if ($factor->company->bankInformation)
                    @include('bank-information.details', ['bankInformation' => $factor->company->bankInformation, 'title' => __('Bank Information'), 'description' => __('Bank Account Information.')])
                @endif
            </div>
        </div>

        <!-- Address Information -->
        <div class="mt-10 sm:mt-0">
            <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">
                @if ($factor->company->address)
                    @include('address.details', ['address' => $factor->company->address, 'title' => __('Address Information'), 'description' => __('Basic Address information.')])
                @endif
            </div>
        </div>

        <x-jet-section-border />

        <!-- Contact Information -->
        <div class="mt-10 sm:mt-0">
            <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">
                @if ($factor->company->contact)
                    @include('contact.details', ['contact' => $factor->company->contact, 'title' => __('Contact Details'), 'description' => __('Basic Contact Details.')])
                @endif
            </div>
        </div>

        <x-jet-section-border />

        <!-- Actions -->
        <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6">

            <a href="{{route('factors.update', $this->factor->id)}}" class="bg-theme-18 text-center mx-2 px-4 py-4 rounded-md font-semibold text-xs text-white tracking-widest focus:outline-none focus:ring disabled:opacity-25 hover:opacity-75 transition">
                {{ __('Update') }}
            </a>

            <x-jet-danger-button wire:click="confirmDeletion" class="text-center xl:mr-3 align-top border-theme-18 focus:ring-theme-18" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-jet-danger-button>


            <!-- Delete Factor Confirmation Modal -->
            <x-dialogs.delete-confirmation>
                <x-slot name="title">Delete Factor</x-slot>
                <x-slot name="description">Are you sure you want to delete factor? Once it is deleted, all of its resources and data will be permanently deleted.</x-slot>
            </x-dialogs.delete-confirmation>

            <!-- Delete Completed Modal -->
            <x-dialogs.delete-completed :actions="['factors.list' => 'Back To Factor List']">
                <x-slot name="title">Factor Deleted</x-slot>
                <x-slot name="description">Factor successfully deleted.</x-slot>
            </x-dialogs.delete-completed>
        </div>

        <!-- Users -->
        <livewire:factor.factor-users-list :factor="$factor"/>
</div>
