<!-- Assigned Clients -->
<div class="col-span-6 sm:col-span-6">
        @foreach($clients as $client)
            <div>
                <span class="text-wrap mx-2 py-3 ">{{$client->ref_code}} {{$client->company->name}}</span>
                <x-danger-anchor wire:click="detachClient({{$client->id}})"> x </x-danger-anchor>
            </div>

        @endforeach
</div>
