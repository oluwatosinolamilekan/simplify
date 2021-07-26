<div class="inline-block w-full my-4">
    <span class="text-xl font-medium mt-auto mb-auto">{{ isset($table_title) ? $table_title : '' }}</span>
    @if(isset($button_text))<x-success-anchor href="{{ isset($button_route) ? $button_route : '' }}" id="{{ isset($button_id) ? $button_id : '' }}" class="mr-0 normal_letter_spacing float-right">{{ isset($button_text) ? $button_text  : '' }}</x-success-anchor>@endif
</div>

<div class="data-table-container bg-white dark:bg-dark-2 p-8 mt-0">
    @if($beforeTableSlot)
        <div class="mt-8">
            @include($beforeTableSlot)
        </div>
    @endif
    <div class="relative">
        <div class="flex justify-between items-center mb-7">
            <div class="flex-grow h-10 flex items-center">
                @if($this->searchableColumns()->count())
                    <div class="md:w-64 lg:w-64 flex rounded-lg shadow-sm">
                        <div class="relative flex-grow focus-within:z-10">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <x-icons.search class="mr-2 text-gray-400"/>
                            </div>

                            <x-input wire:model.debounce.500ms="search" class="mt-auto py-2.5 px-9" placeholder="Search..." />
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <x-clear-filter wire:click="$set('search', null)"/>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="flex items-center space-x-1">
                <x-icons.cog wire:loading class="h-9 w-9 animate-spin text-gray-400" />

                @if($exportable)
                    <div x-data="{ init() {
                    window.livewire.on('startDownload', link => window.open(link,'_blank'))
                } }" x-init="init">
                        <x-light-anchor href="#" wire:click="export">
                            <x-icons.file-text x-cloak/>
                            <span>Export</span>
                        </x-light-anchor>
                    </div>
                @endif


                @if($hideable === 'select')
                    @include('datatables::hide-column-multiselect')
                @endif
            </div>
        </div>

        @if($hideable === 'buttons')
            <div class="p-2 grid grid-cols-8 gap-2">
                @foreach($this->columns as $index => $column)
                    <button wire:click.prefetch="toggle('{{ $index }}')" class="px-3 py-2 rounded text-white text-xs focus:outline-none
            {{ $column['hidden'] ? 'bg-blue-100 hover:bg-blue-300 text-blue-600' : 'bg-blue-500 hover:bg-blue-800' }}">
                        {{ $column['label'] }}
                    </button>
                @endforeach
            </div>
        @endif

        <div class="rounded-lg shadow-lg bg-white dark:bg-dark-1 max-w-screen overflow-x-auto">
            <div class="rounded-lg @unless($this->hidePagination) rounded-b-none @endif">
                <div class="table align-middle min-w-full">
                    @unless($this->hideHeader)
                        <div class="table-row dark:bg-dark-1">
                            @foreach($this->columns as $index => $column)
                                @if($hideable === 'inline')
                                    @include('datatables::header-inline-hide', ['column' => $column, 'sort' => $sort])
                                @elseif($column['type'] === 'checkbox')
                                    <div class="relative table-cell h-12 w-12 overflow-hidden align-top px-6 py-3 border-b border-gray-300 bg-gray-50 dark:bg-dark-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider flex items-center focus:outline-none">
                                        <div class="px-1 py-1 rounded @if(count($selected)) bg-orange-400 @else bg-gray-200 @endif text-gray-500 text-center dark:bg-dark-2">
                                            {{ count($selected) }}
                                        </div>
                                    </div>
                                @else
                                    @include('datatables::header-no-hide', ['column' => $column, 'sort' => $sort])
                                @endif
                            @endforeach
                        </div>

                        <div class="table-row bg-white dark:bg-dark-1">
                            @foreach($this->columns as $index => $column)
                                @if($column['hidden'])
                                    @if($hideable === 'inline')
                                        <div class="table-cell border-b border-gray-300 w-5 overflow-hidden align-top"></div>
                                    @endif
                                @elseif($column['type'] === 'checkbox')
                                    <div class="table-cell w-32 overflow-hidden align-top px-6 py-3.5 border-b border-gray-300 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider flex h-full flex-col items-center space-y-2 focus:outline-none">
                                        {{--<div>SELECT ALL</div>--}}
                                        <div class="text-center">
                                            <input type="checkbox" wire:click="toggleSelectAll" @if(count($selected) === $this->results->total()) checked @endif class="rounded shadow-sm focus:ring focus:ring-opacity-50 form-check-input border mr-2 focus:border-theme-18 focus:ring-offset-theme-18 focus:ring-theme-18" />
                                        </div>
                                    </div>
                                @elseif($column['type'] === 'actions')
                                    <div class="table-cell border-b border-gray-300 w-5 overflow-hidden align-top">
                                        @if ($this->getActiveFiltersProperty())
                                            <x-light-anchor wire:click="clearAllFilters" class="mr-2.5 h-8 mt-2.5 pt-1.5 dark:bg-dark-2">
                                                <span class="nowrap">Clear All</span>
                                            </x-light-anchor>
                                        @endif
                                    </div>
                                @else
                                    <div class="filter_cell table-cell table_cell_min_width overflow-hidden align-top border-b border-gray-300">
                                        @isset($column['filterable'])
                                            @if( is_iterable($column['filterable']) )
                                                <div wire:key="{{ $index }}">
                                                    @include('datatables::filters.select', ['index' => $index, 'name' => $column['label'], 'options' => $column['filterable']])
                                                </div>
                                            @else
                                                <div wire:key="{{ $index }}">
                                                    @include('datatables::filters.' . ($column['filterView'] ?? $column['type']), ['index' => $index, 'name' => $column['label']])
                                                </div>
                                            @endif
                                        @endisset
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                    @foreach($this->results as $result)
                        <div class="table-row p-1 dark:bg-dark-1 {{ isset($result->checkbox_attribute) && in_array($result->checkbox_attribute, $selected) ? 'bg-orange-100' : ($loop->even ? 'bg-white' : 'bg-white') }}">
                            @foreach($this->columns as $column)
                                @if($column['hidden'])
                                    @if($hideable === 'inline')
                                        <div class="table-cell border-b border-gray-300 w-5 overflow-hidden align-top"></div>
                                    @endif
                                @elseif($column['type'] === 'checkbox')
                                    @include('datatables::checkbox', ['value' => $result->checkbox_attribute])
                                @else
                                    <div class="relative table_cell_value min-w-min pl-1 pr-4 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900 dark:text-white table-cell border-b border-gray-300 @if($column['align'] === 'right') text-right @elseif($column['align'] === 'center') text-center @else text-left @endif">
                                        {!! $result->{$column['name']} !!}
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
            @if(empty($this->results[0]))
                <div class="text-center">
                    <p class="p-3 text-lg text-teal-600">
                        There's nothing to show at the moment
                    </p>
                </div>
            @endif

            @unless($this->hidePagination)
                <div class="rounded-lg rounded-t-none max-w-screen rounded-lg border-b border-gray-200 bg-white dark:bg-dark-1">
                    <div class="p-2 sm:flex items-center justify-between">
                        {{-- check if there is any data --}}
                        @if($this->results[1])
                            <div class="my-2 sm:my-0 flex items-center">
                                <x-select name="perPage" wire:model="perPage" class="h-8 pt-1 pb-1 pr-8 dark:bg-dark-2">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="99999999">All</option>
                                </x-select>
                            </div>

                            <div class="my-4 sm:my-0">
                                <div class="lg:hidden">
                                    <span class="space-x-2">{{ $this->results->links('datatables::tailwind-simple-pagination') }}</span>
                                </div>

                                <div class="hidden lg:flex justify-center">
                                    <span>{{ $this->results->links('datatables::tailwind-pagination') }}</span>
                                </div>
                            </div>

                            <div class="flex justify-end text-gray-600">
                                Results {{ $this->results->firstItem() }} - {{ $this->results->lastItem() }} of
                                {{ $this->results->total() }}
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
    @if($afterTableSlot)
        <div class="mt-8">
            @include($afterTableSlot)
        </div>
    @endif
</div>
