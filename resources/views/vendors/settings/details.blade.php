
<div class="mt-5 md:mt-0 md:col-span-2">
    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
        <div class="grid grid-cols-6 gap-6">

            <!-- Buy Status -->
            <div class="col-span-3 sm:col-span-3">
                <x-jet-label for="buy_status" value="{{ __('Buy / No Buy') }}"  class="sm:inline-block"/>
                @if($settings->buy_status)
                    <x-icons.circle-check class="text-green-600 mx-0 inline" />
                @else
                    <x-icons.circle-x class="text-red-300 mx-0 inline" />
                @endif
            </div>

            <!-- Send Email Remittances -->
            <div class="col-span-3 sm:col-span-3">
                <x-jet-label for="send_email_remittances" value="{{ __('Send Email Remittances') }}" class="sm:inline-block"/>
                @if($settings->send_email_remittances)
                    <x-icons.circle-check class="text-green-600 mx-0 inline" />
                @else
                    <x-icons.circle-x class="text-red-300 mx-0 inline" />
                @endif
            </div>

        </div>
    </div>
</div>
