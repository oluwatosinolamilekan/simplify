<div>

    <div class="mt-10 sm:mt-0">
        <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

            <x-jet-section-title>
                <x-slot name="title">{{ __('Debtor Credit') }}</x-slot>
                <x-slot name="description">{{ __('Fill debtor credit information.') }}</x-slot>
            </x-jet-section-title>

            @if ($credit->exists)
                @include('debtors.credit.partials.credit-details', ['credit' => $credit])
            @else
                <div class="mt-5 md:mt-0 md:col-span-2" >
                    <x-collapsible-container  :collapseButton="'Cancel'" :expandButton="'+Add'">llapsible-container>
                        <x-slot name="form">
                            <livewire:debtor.debtor-credit-form :credit="$credit" :partial="false" :nested="true"/>
                        </x-slot>
                    </x-collapsible-container>
                </div>
            @endif

        </div>
    </div>


    <div class="mt-10 sm:mt-0">
        <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

            <x-jet-section-title>
                <x-slot name="title">{{ __('Debtor Credit Limit') }}</x-slot>
                <x-slot name="description">{{ __('Fill debtor credit limit information.') }}</x-slot>
            </x-jet-section-title>

            @if ($creditLimit->exists)
                @include('debtors.credit.partials.credit-limit-details', ['creditLimit' => $creditLimit])
            @else
                <x-collapsible-container  :collapseButton="'Cancel'" :expandButton="'+Add'">llapsible-container>
                    <x-slot name="form">
                        <livewire:debtor.debtor-credit-limit-form :creditLimit="$creditLimit" :partial="false" :nested="true"/>
                    </x-slot>
                </x-collapsible-container>

            @endif

        </div>
    </div>
</div>


