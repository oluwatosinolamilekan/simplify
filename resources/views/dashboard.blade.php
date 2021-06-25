<x-app-layout :bodyClass="'main'">
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    <div class="mt-8">
        <x-tabs/>
    </div>
</x-app-layout>
