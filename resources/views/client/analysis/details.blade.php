
<div class="mt-5 md:mt-0 md:col-span-2">
    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
        <div class="grid grid-cols-6 gap-6">

            <!-- Business Type -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="business_type" value="{{ __('Business Type') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $analysis->business_type->description }}
                </span>
            </div>

            <!-- Industry -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="industry" value="{{ __('Industry') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $analysis->industry }}
                </span>
            </div>

            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="region" value="{{ __('Region') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $analysis->region }}
                </span>
            </div>

            <!-- Loan Grade -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="loan_grade" value="{{ __('Loan Grade') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $analysis->loan_grade }}
                </span>
            </div>

        </div>
    </div>
</div>
