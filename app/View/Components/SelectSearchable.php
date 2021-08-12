<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components;

use Asantibanez\LivewireSelect\LivewireSelect;
use Illuminate\Support\Collection;

class SelectSearchable extends LivewireSelect
{
    public $selectOptions;
    public $wire;

    public function mount(
        $wire,
        $value = null,
        $placeholder = 'Select an option',
        $searchable = false,
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

        parent::mount(
            $wire,
            $value,
            $placeholder,
            true,
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

    public function selectedOption($value)
    {
        $this->emitUp('update', $this->wire, $value);

        return $this->selectOptions->where('value', $value)->first();
    }


    public function styles()
    {
        return [
            'default' => 'p-2 rounded border w-full appearance-none',

            'searchSelectedOption' => 'p-2 rounded border w-full bg-white flex items-center',
            'searchSelectedOptionTitle' => 'w-full text-gray-900 text-left',
            'searchSelectedOptionReset' => 'h-4 w-4 text-gray-500',

            'search' => 'relative',
            'searchInput' => 'p-2 rounded border w-full rounded',
            'searchOptionsContainer' => 'absolute top-0 left-0 mt-12 w-full z-10',

            'searchOptionItem' => 'py-3 px-4 border-gray-300',
            'searchOptionItemActive' => 'bg-indigo-600 text-white font-medium',
            'searchOptionItemInactive' => 'bg-white text-gray-600',

            'searchNoResults' => 'p-8 w-full bg-white border text-center text-xs text-gray-600',
        ];
    }

    public function render()
    {

        $options = $this->options($this->searchTerm);

        $this->optionsValues = $options->pluck('value')->toArray();

        if ($this->value != null) {
            $selectedOption = $this->selectedOption($this->value);
        }

        $shouldShow = $this->waitForDependenciesToShow
            ? $this->allDependenciesMet()
            : true;

        $styles = $this->styles();

        return view($this->selectView)
            ->with([
                'options' => $options,
                'selectedOption' => $selectedOption ?? null,
                'shouldShow' => $shouldShow,
                'styles' => $styles,
            ]);
    }
}
