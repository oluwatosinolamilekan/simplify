
<div class="mt-5 md:mt-0 md:col-span-2">
    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
        <div class="grid grid-cols-6 gap-6">

            <!-- Generate Invoice -->
            <div class="col-span-3 sm:col-span-3">
                <x-jet-label for="generate_invoice" value="{{ __('Generate Invoice') }}"  class="sm:inline-block"/>
                <x-forms.toggle-input id="generate_invoice" wire:model="fundingInstructions.generate_invoice"/>
                <x-jet-input-error for="fundingInstructions.generate_invoice" class="mt-2" />
            </div>

            <!-- Send Invoice -->
            <div class="col-span-3 sm:col-span-3">
                <x-jet-label for="send_invoice" value="{{ __('Send Invoice') }}" class="sm:inline-block"/>
                <x-forms.toggle-input id="send_invoice" wire:model="fundingInstructions.send_invoice"/>
                <x-jet-input-error for="fundingInstructions.send_invoice" class="mt-2" />
            </div>

            <!-- Max Invoice Amount -->
            <div class="col-span-3 sm:col-span-3">
                <x-jet-label for="max_invoice_amount" value="{{ __('Max Invoice Amount') }}" />
                <x-forms.currency-input wire:model="fundingInstructions.max_invoice_amount" />
                <x-jet-input-error for="fundingInstructions.max_invoice_amount" class="mt-2" />
            </div>

            <!-- EFS Available -->
            <div class="col-span-3 sm:col-span-3">
                <x-jet-label for="efs_available" value="{{ __('EFS Available') }}"/>
                <x-forms.toggle-input id="efs_available" wire:model="fundingInstructions.efs_available"/>
                <x-jet-input-error for="fundingInstructions.efs_available" class="mt-2" />
            </div>

            <!-- Fuel Advance Fee -->
            <div class="col-span-3 sm:col-span-3">
                <x-jet-label for="fuel_advance_fee" value="{{ __('Fuel Advance Fee') }}"/>
                <x-forms.currency-input wire:model="fundingInstructions.fuel_advance_fee"/>
                <x-jet-input-error for="fundingInstructions.fuel_advance_fee" class="mt-2" />
            </div>

            <!-- Fuel Advance Max Rate -->
            <div class="col-span-3 sm:col-span-3">
                <x-jet-label for="fuel_advance_max_rate" value="{{ __('Fuel Advance Max Rate') }}" />
                <x-forms.rate-input wire:model="fundingInstructions.fuel_advance_max_rate" />
                <x-jet-input-error for="fundingInstructions.fuel_advance_max_rate" class="mt-2" />
            </div>

            <!-- Allow Fundings -->
            <div class="col-span-3 sm:col-span-3">
                <x-jet-label for="allow_fundings" value="{{ __('Allow Fundings') }}"/>
                <x-forms.toggle-input id="allow_fundings" wire:model="fundingInstructions.allow_fundings"/>
                <x-jet-input-error for="fundingInstructions.allow_fundings" class="mt-2" />
            </div>

            <!-- Allow Reserve Releases -->
            <div class="col-span-3 sm:col-span-3">
                <x-jet-label for="allow_reserve_releases" value="{{ __('Allow Reserve Releases') }}"/>
                <x-forms.toggle-input id="allow_reserve_releases" wire:model="fundingInstructions.allow_reserve_releases"/>
                <x-jet-input-error for="fundingInstructions.allow_reserve_releases" class="mt-2" />
            </div>

            <!-- Funding Limit -->
            <div class="col-span-3 sm:col-span-3">
                <x-jet-label for="funding_limit" value="{{ __('Funding Limit') }}" />
                <x-forms.currency-input wire:model="fundingInstructions.funding_limit" />
                <x-jet-input-error for="fundingInstructions.funding_limit" class="mt-2" />
            </div>

            <!-- Send Email Remittances -->
            <div class="col-span-3 sm:col-span-3">
                <x-jet-label for="send_email_remittances" value="{{ __('Send Email Remittances') }}"/>
                <x-forms.toggle-input id="send_email_remittances" wire:model="fundingInstructions.send_email_remittances"/>
                <x-jet-input-error for="fundingInstructions.send_email_remittances" class="mt-2" />
            </div>

            <!-- Schedule Submission Email -->
            <div class="col-span-6 sm:col-span-6">
                <x-jet-label for="schedule_submission_email" value="{{ __('Schedule Submission Email') }}" />
                <x-jet-input id="schedule_submission_email" type="text" wire:model="fundingInstructions.schedule_submission_email" class="w-1/2 float-right" autocomplete="email" />
                <x-jet-input-error for="fundingInstructions.schedule_submission_email" class="mt-2" />
            </div>

            <!-- Warning Notes -->
            <div class="col-span-6 sm:col-span-6">
                <x-jet-label for="warning_note" value="{{ __('Warning Notes') }}"/>
                <div class="sm:inline-block w-1/2 float-right">
                    <x-jet-input id="warning_note" type="text" wire:model="warningNote" class="w-3/4"/>
                    <a wire:click="click" class="w-1/4 p-4 cursor-pointer bg-theme-18 text-center px-3 py-3 rounded-md font-semibold text-xs text-white tracking-widest focus:outline-none focus:ring disabled:opacity-25 hover:opacity-75 transition" href="javascript:;">
                        + Add
                    </a>
                    <x-jet-input-error for="warningNote" class="mt-2" />
                </div>



                <div class="col-span-6 sm:col-span-4 offset-2">
                @foreach($fundingInstructions->warning_notes as $i => $note)
                    <div>
                        <span class="text-wrap mx-2 py-3 sm:inline-block w-5/6">{{$note}}</span>
                        <a wire:click="deleteNote" class="sm:inline-block w-1/6 cursor-pointer text-center mx-2 py-3 rounded-md font-semibold text-xs text-white tracking-widest focus:outline-none focus:ring disabled:opacity-25 hover:opacity-75 transition" href="javascript:;">
                            x
                        </a>
                    </div>

                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
