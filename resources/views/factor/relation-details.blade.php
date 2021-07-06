
<x-jet-section-title>
    <x-slot name="title">{{ $title }}</x-slot>
    <x-slot name="description">{{ $description }}</x-slot>
</x-jet-section-title>

<div class="mt-5 md:mt-0 md:col-span-2">
    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
        <div class="grid grid-cols-6 gap-6">

            <!-- Ref Code -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="ref_code" value="{{ __('Ref Code') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $factor->ref_code }}
                </span>
            </div>

            <!-- Status -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="status" value="{{ __('Status') }}" />
                @if($factor->status->is(\App\Enums\Status::Active))
                    <x-icons.check-circle class="text-green-600 mx-0 inline" />
                @else
                    <x-icons.x-circle class="text-red-300 mx-0 inline" />
                @endif
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{$factor->status->description}}
                </span>
            </div>

            <!-- Subscription plan -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="subscription_plan" value="{{ __('Subscription Plan') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $factor->subscriptionPlan->name }}
                </span>
            </div>


        </div>
    </div>
</div>

