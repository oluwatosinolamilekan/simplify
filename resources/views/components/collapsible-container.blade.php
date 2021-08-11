@php
    $open = !isset($collapsed) || $collapsed ? 'false' : 'true';
    $button = isset($expandButton) || isset($collapseButton);
@endphp

<div class="mt-5 md:mt-0 md:col-span-2"
     x-data="{
          open: {{ $open }},
          get isOpen() { return this.open },
          toggle() { this.open = ! this.open },
        }">
    <div class="px-4 py-5 text-right sm:p-6 shadow sm:rounded-md">
        <span class="float-left">{{ $header ?? ''}}</span>
        @if($button)
        <x-success-anchor @click="toggle()">
            <span x-text="!open ? '{{ $expandButton ?? 'Add' }}' : '{{ $collapseButton ?? 'Cancel' }}' "></span>
        </x-success-anchor>
        @else
            <a @click="toggle()" class="text-center px-4 py-3 mx-2 rounded-md font-semibold cursor-pointer">
                <i :class="open ? 'chevron down' : 'chevron up'"></i>
            </a>
        @endif
    </div>
    <div x-show="isOpen">
        {{$form}}
    </div>
</div>
