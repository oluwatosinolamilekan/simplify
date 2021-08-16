
<div class="mt-5 md:mt-0 md:col-span-2">
    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
        <div class="grid grid-cols-6 gap-6">

            <!-- Generate Invoice -->
            <div class="col-span-3 sm:col-span-3">
                <x-jet-label for="generate_invoice" value="{{ __('Generate Invoice') }}"  class="sm:inline-block"/>
                @if($fundingInstructions->generate_invoice)
                    <x-icons.circle-check class="text-green-600 mx-0 inline" />
                @else
                    <x-icons.circle-x class="text-red-300 mx-0 inline" />
                @endif
            </div>

            <!-- Send Invoice -->
            <div class="col-span-3 sm:col-span-3">
                <x-jet-label for="send_invoice" value="{{ __('Send Invoice') }}" class="sm:inline-block"/>
                @if($fundingInstructions->send_invoice)
                    <x-icons.circle-check class="text-green-600 mx-0 inline" />
                @else
                    <x-icons.circle-x class="text-red-300 mx-0 inline" />
                @endif
            </div>

            <!-- Max Invoice Amount -->
            <div class="col-span-3 sm:col-span-3">
                <x-jet-label for="max_invoice_amount" value="{{ __('Max Invoice Amount') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $fundingInstructions->max_invoice_amount }}
                </span>
            </div>

            <!-- EFS Available -->
            <div class="col-span-3 sm:col-span-3">
                <x-jet-label for="efs_available" value="{{ __('EFS Available') }}"/>
                @if($fundingInstructions->efs_available)
                    <x-icons.circle-check class="text-green-600 mx-0 inline" />
                @else
                    <x-icons.circle-x class="text-red-300 mx-0 inline" />
                @endif
            </div>

            <!-- Fuel Advance Fee -->
            <div class="col-span-3 sm:col-span-3">
                <x-jet-label for="fuel_advance_fee" value="{{ __('Fuel Advance Fee') }}"/>
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $fundingInstructions->fuel_advance_fee }}
                </span>
            </div>

            <!-- Fuel Advance Max Rate -->
            <div class="col-span-3 sm:col-span-3">
                <x-jet-label for="fuel_advance_max_rate" value="{{ __('Fuel Advance Max Rate') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $fundingInstructions->fuel_advance_max_rate }}
                </span>
            </div>

            <!-- Allow Fundings -->
            <div class="col-span-3 sm:col-span-3">
                <x-jet-label for="allow_fundings" value="{{ __('Allow Fundings') }}"/>
                @if($fundingInstructions->allow_fundings)
                    <x-icons.circle-check class="text-green-600 mx-0 inline" />
                @else
                    <x-icons.circle-x class="text-red-300 mx-0 inline" />
                @endif
            </div>

            <!-- Allow Reserve Releases -->
            <div class="col-span-3 sm:col-span-3">
                <x-jet-label for="allow_reserve_releases" value="{{ __('Allow Reserve Releases') }}"/>
                @if($fundingInstructions->allow_reserve_releases)
                    <x-icons.circle-check class="text-green-600 mx-0 inline" />
                @else
                    <x-icons.circle-x class="text-red-300 mx-0 inline" />
                @endif
            </div>

            <!-- Funding Limit -->
            <div class="col-span-3 sm:col-span-3">
                <x-jet-label for="funding_limit" value="{{ __('Funding Limit') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $fundingInstructions->funding_limit }}
                </span>
            </div>

            <!-- Send Email Remittances -->
            <div class="col-span-3 sm:col-span-3">
                <x-jet-label for="send_email_remittances" value="{{ __('Send Email Remittances') }}"/>
                @if($fundingInstructions->send_email_remittances)
                    <x-icons.circle-check class="text-green-600 mx-0 inline" />
                @else
                    <x-icons.circle-x class="text-red-300 mx-0 inline" />
                @endif
            </div>

            <!-- Schedule Submission Email -->
            <div class="col-span-6 sm:col-span-6">
                <x-jet-label for="schedule_submission_email" value="{{ __('Schedule Submission Email') }}" />
                <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    {{ $fundingInstructions->schedule_submission_email }}
                </span>
            </div>

            <!-- Warning Notes -->
            <div class="col-span-6 sm:col-span-6">
                <x-jet-label for="warning_note" value="{{ __('Warning Notes') }}"/>
                <div class="col-span-6 sm:col-span-4 offset-2">
                    @foreach($fundingInstructions->warning_notes as $i => $note)
                        <div>
                            <span class="text-wrap mx-2 py-3 sm:inline-block w-5/6">{{$note}}</span>
                        </div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
