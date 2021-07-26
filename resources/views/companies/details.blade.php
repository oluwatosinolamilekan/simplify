
<x-jet-section-title>
    <x-slot name="title">{{ $title ?? 'Company Information' }}</x-slot>
    <x-slot name="description">{{ $description ?? 'Company Basic Information.' }}</x-slot>
</x-jet-section-title>

<div class="mt-5 md:mt-0 md:col-span-2">
    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
        <div class="grid grid-cols-6 gap-6">

            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $company->name }}
                </span>
            </div>

            <!-- Domain -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="domain" value="{{ __('Domain') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $company->domain }}
                </span>
                <span class="font-bold">.{{getenv('APP_BASE_DOMAIN')}}</span>
            </div>

            <!-- Status -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="role" value="{{ __('Status') }}" />
                @if($company->status->is(\App\Enums\Status::Active))
                    <x-icons.check-circle class="text-green-600 mx-0 inline" />
                @else
                    <x-icons.x-circle class="text-red-300 mx-0 inline" />
                @endif
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{$company->status->description}}
                </span>
            </div>


        </div>
    </div>
</div>

