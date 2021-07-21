@props(['name'])

<div x-data="{
        id: '',
        name: '{{ $name }}',
        show: false,
        showIfActive(active) {
            this.show = (this.name === active);
        }
    }"
     class="mt-5 px-4 pb-4"
     x-show="show"
     role="tabpanel"
     :aria-labelledby="`tab-${id}`"
     :id="`tab-panel-${id}`"
>
    {{ $slot }}
</div>
