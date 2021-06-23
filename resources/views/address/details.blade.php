
<x-jet-section-title>
    <x-slot name="title">{{ $title }}</x-slot>
    <x-slot name="description">{{ $description }}</x-slot>
</x-jet-section-title>

<div class="mt-5 md:mt-0 md:col-span-2">
    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
        <div class="grid grid-cols-6 gap-6">

            <!-- Street -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="street" value="{{ __('Street') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $address->street }}
                </span>
            </div>

            <!-- City -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="city" value="{{ __('City') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $address->city }}
                </span>
            </div>

            <!-- State -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="state" value="{{ __('State') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $address->state }}
                </span>
            </div>

            <!-- Country -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="country" value="{{ __('Country') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $address->country }}
                </span>
            </div>


            <!-- ZIP Code -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="zip_code" value="{{ __('ZIP Code') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $address->zip_code }}
                </span>
            </div>

            <!-- Mail Code -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="mail_code" value="{{ __('Mail Code') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $address->mail_code }}
                </span>
            </div>

            <!-- Timezone -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="mail_code" value="{{ __('Timezone') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $address->timezone }}
                </span>
            </div>


        </div>
    </div>
</div>

