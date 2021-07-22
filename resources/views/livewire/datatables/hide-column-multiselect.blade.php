<div x-data="{ show: false }" class="flex flex-col items-center">
    <div class="flex flex-col items-center relative">
        <x-light-anchor href="#" x-on:click="show = !show" class="mr-0">Show / Hide Columns</x-light-anchor>
        <div x-show="show" x-on:click.away="show = false" class="z-50 absolute mt-0 mr-0 shadow-2xl top-100 bg-white z-40 w-64 right-0 rounded max-h-select overflow-y-auto" style="display: none" x-cloak>
            <div class="flex flex-col w-full">
                @foreach($this->columns as $index => $column)
                    @if(!empty($column['label']))
                        <div>
                            <div class="@unless($column['hidden']) hidden @endif cursor-pointer w-full border-gray-400 border-b bg-gray-200 text-gray-500 transition ease-in-out" wire:click="toggle({{$index}})">
                                <div class="relative flex w-full items-center p-2 group">
                                    <div class=" w-full items-center flex">
                                        <div class="mx-2 leading-6">{{ $column['label'] }}</div>
                                    </div>
                                    <div class="absolute inset-y-0 right-0 pr-2 flex items-center">
                                        <x-icons.check-circle class="h-3 w-3 stroke-current text-gray-500 hover:text-theme-18" />
                                    </div>
                                </div>
                            </div>
                            <div class="@if($column['hidden']) hidden @endif cursor-pointer w-full border-gray-400 border-b bg-white text-gray-700 hover:text-gray-400 transition ease-in-out" wire:click="toggle({{$index}})">
                                <div class="relative flex w-full items-center p-2 group">
                                    <div class=" w-full items-center flex">
                                        <div class="mx-2 leading-6">{{ $column['label'] }}</div>
                                    </div>
                                    <div class="absolute inset-y-0 right-0 pr-2 flex items-center">
                                        <x-icons.x-circle class="h-3 w-3 stroke-current text-gray-700 hover:text-red-400" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>

<style>
    .top-100 {
        top: 100%
    }

    .bottom-100 {
        bottom: 100%
    }

    .max-h-select {
        max-height: 300px;
    }

</style>
