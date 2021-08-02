<div class="mt-5 md:mt-0 md:col-span-2"
     x-data="{
          open: {{ !isset($collapsed) || $collapsed ? 'false' : 'true' }},
          get isOpen() { return this.open },
          toggle() { this.open = ! this.open },
        }">
    <div class="px-4 py-5 text-right sm:p-6 shadow sm:rounded-md">
        <span class="float-left">{{ $header ?? ''}}</span>
        <x-success-anchor @click="toggle()">
            <span x-text="!open ? 'Add' : 'Cancel' "></span>
        </x-success-anchor>
    </div>
    <div x-show="isOpen">
        {{$form}}
    </div>
</div>
