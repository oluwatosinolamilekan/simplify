<x-app-layout :bodyClass="'main'">
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    <div class="mt-8">
        <h2 class="text-lg">Welcome Addio application!</h2>
    </div>

    <?php
    $values = (object) array (
        (object) array('id' => '1', 'name' => 'mek', 'selected' => 'selected'),
        (object) array('id' => '2', 'name' => 'erku', 'selected' => ''),
        (object) array('id' => '3', 'name' => 'ereq', 'selected' => 'selected'),
        (object) array('id' => '4', 'name' => 'chors', 'selected' => '')
    );
    ?>

    <div class="intro-y box mt-5">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-base mr-auto">
                Multi Select
            </h2>
        </div>
        <x-multiple-select :values="$values"/>
    </div>
</x-app-layout>
