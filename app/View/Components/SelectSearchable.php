<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components;

use Aabosham\LivewireSelect\LivewireSelect;
use Illuminate\Support\Collection;

class SelectSearchable extends LivewireSelect
{
    public $selectOptions;
    public $wire;
    public $multiple;
    public $changeEvent;

    public function mount(
        $wire,
        $value = [],
        $placeholder = 'Select an option',
        $searchable = false,
        $multiple = false,
        $dependsOn = [],
        $dependsOnValues = [],
        $waitForDependenciesToShow = false,
        $noResultsMessage = 'No options found',
        $selectView = 'livewire-select::select',
        $defaultView = 'livewire-select::default',
        $searchView = 'livewire-select::search',
        $searchInputView = 'livewire-select::search-input',
        $searchOptionsContainer = 'livewire-select::search-options-container',
        $searchOptionItem = 'livewire-select::search-option-item',
        $searchSelectedOptionView = 'livewire-select::search-selected-option',
        $searchNoResultsView = 'livewire-select::search-no-results',
        $extras = []
    )
    {
        $this->wire = $wire;
        $this->multiple = $multiple;

        parent::mount(
            $wire,
            $value,
            $placeholder,
            true,
            $multiple,
            $dependsOn,
            $dependsOnValues,
            $waitForDependenciesToShow,
            $noResultsMessage,
            $selectView,
            $defaultView,
            $searchView,
            $searchInputView,
            $searchOptionsContainer,
            $searchOptionItem,
            $searchSelectedOptionView,
            $searchNoResultsView,
            $extras
        );
    }

    public function options($searchTerm = null): Collection
    {
        if (empty($searchTerm)) {
            return $this->selectOptions;
        }

        return $this->selectOptions
            ->filter(fn ($item) => str_contains(strtolower($item['description']), strtolower($searchTerm)));
    }

    public function updatedProperty($value)
    {
        $this->changeEvent = $value;
    }

    public function selectedOption($value)
    {
        $this->emitUp('update', $this->wire, $value);

        return $this->selectOptions->where('value', $value)->first();
    }

    public function styles()
    {
        return [
            'default' => 'p-2 input w-full appearance-none',

            'searchSelectedOption' => 'bg-blue-700 mx-1 my-2 border border-gray-400 flex items-center',
            'searchSelectedOptionTitle' => 'text-blue-100 text-start px-2',
            'searchSelectedOptionReset' => 'h-4 w-4 text-blue-100 mx-1',

            'search' => 'w-full relative',
            'searchInput' => 'input shadow-sm p-2 w-full border border-gray-400',
            'searchOptionsContainer' => 'bg-gray-100  border border-gray-400 absolute top-0 start-0 mt-12 w-full z-20 h-96 overflow-y-auto',
            'searchContainer' => 'flex flex-wrap border border-gray-400',

            'searchOptionItem' => 'p-3 hover:bg-gray-300 hover:text-gray-700 cursor-pointer',
            'searchOptionItemActive' => 'bg-gray-300 text-black font-medium',
            'searchOptionItemInactive' => 'bg-white text-gray-600',

            'searchNoResults' => 'p-8 w-full bg-gray-100 text-center text-gray-600',
        ];
    }


}
