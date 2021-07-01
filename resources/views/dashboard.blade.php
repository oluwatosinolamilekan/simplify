<x-app-layout :bodyClass="'main'">
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    <div class="mt-8">
        <h2 class="text-lg">Welcome Addio application!</h2>
    </div>


    <div class="intro-y box mt-5">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-base mr-auto">
                Multi Select
            </h2>
        </div>
        <x-multiple-select/>
    </div>
</x-app-layout>
