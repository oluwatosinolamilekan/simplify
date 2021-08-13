
<x-jet-section-title>
    <x-slot name="title">{{ $title ?? 'Vendor Information'}}</x-slot>
    <x-slot name="description">{{ $description ?? 'Vendor Basic Information.'}}</x-slot>
</x-jet-section-title>

<div class="mt-5 md:mt-0 md:col-span-2">
    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
        <div class="grid grid-cols-6 gap-6">

            <!-- Ref Code -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="ref_code" value="{{ __('Ref Code') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $vendor->ref_code }}
                </span>
            </div>

            <!-- Vendor Name -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="name" value="{{ __('Vendor Name') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $vendor->name }}
                </span>
            </div>

            <!-- Status -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="status" value="{{ __('Status') }}" />
                @if($vendor->status->is(\App\Enums\Status::Active))
                    <x-icons.circle-check class="text-green-600 mx-0 inline" />
                @else
                    <x-icons.circle-x class="text-red-300 mx-0 inline" />
                @endif
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{$vendor->status->description}}
                </span>
            </div>

            <!-- Factor -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="client" value="{{ __('Client') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $vendor->client->ref_code }} {{ $vendor->client->company->name }}
                </span>
            </div>


        </div>
    </div>
</div>

<?php
