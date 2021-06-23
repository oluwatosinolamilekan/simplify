
<x-jet-section-title>
    <x-slot name="title">{{ $title }}</x-slot>
    <x-slot name="description">{{ $description }}</x-slot>
</x-jet-section-title>

<div class="mt-5 md:mt-0 md:col-span-2">
    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
        <div class="grid grid-cols-6 gap-6">

            <!-- Emails -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="emails" value="{{ __('Emails') }}" />
                @foreach($contact->emails as $email)
                    <span class="border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        {{ $email }}
                    </span>
                @endforeach
            </div>

            <!-- Phone Numbers -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="phone_numbers" value="{{ __('Phone Numbers') }}" />
                @foreach($contact->phone_numbers as $phone)
                    <span class="border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        {{ $phone }}
                    </span>
                @endforeach
            </div>

            <!-- Notes -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="phone_numbers" value="{{ __('Notes') }}" />
                @foreach($contact->notes as $note)
                    <span class="border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        {{ $note }}
                    </span>
                @endforeach
            </div>


        </div>
    </div>
</div>

