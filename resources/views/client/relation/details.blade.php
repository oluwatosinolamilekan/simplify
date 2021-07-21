
<x-jet-section-title>
    <x-slot name="title">{{ $title ?? 'Client Information'}}</x-slot>
    <x-slot name="description">{{ $description ?? 'Client Basic Information.'}}</x-slot>
</x-jet-section-title>

<div class="mt-5 md:mt-0 md:col-span-2">
    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
        <div class="grid grid-cols-6 gap-6">

            <!-- Ref Code -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="ref_code" value="{{ __('Ref Code') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $client->ref_code }}
                </span>
            </div>

            <!-- Client Name -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="name" value="{{ __('Client Name') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $client->name }}
                </span>
            </div>

            <!-- Office -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="name" value="{{ __('Office') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $client->office }}
                </span>
            </div>

            <!-- Status -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="status" value="{{ __('Status') }}" />
                @if($client->status->is(\App\Enums\Status::Active))
                    <x-icons.check-circle class="text-green-600 mx-0 inline" />
                @else
                    <x-icons.x-circle class="text-red-300 mx-0 inline" />
                @endif
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{$client->status->description}}
                </span>
            </div>

            <!-- Status -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="type" value="{{ __('Type') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{$client->type->description}}
                </span>
            </div>

            <!-- Factor -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="factor" value="{{ __('Factor') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $client->factor->ref_code }} {{ $client->factor->company->name }}
                </span>
            </div>


        </div>
    </div>
</div>

<?php
