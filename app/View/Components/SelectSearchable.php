<?php

namespace App\View\Components;

use Illuminate\Support\Collection ;
use Asantibanez\LivewireSelect\LivewireSelect;

class SelectSearchable extends LivewireSelect
{
    public $selectOptions;

    public function options($searchTerm = null) : Collection
    {
        return $this->selectOptions->filter(fn ($item) => empty($searchTerm)
                                    || str_contains(strtolower($item['description']), strtolower($searchTerm)
                                ));
    }



    public function selectedOption($value)
    {
//        $this->emitUp('updated', 'client.status', $value);
        return $this->selectOptions->where('value', $value)->first();

    }

    public function selectValue($value)
    {
        $this->value = $value;

        if ($this->searchable && $this->value == null) {
            $this->emit('livewire-select-focus-search', ['name' => $this->name]);
        }

        if ($this->searchable && $this->value != null) {
            $this->emit('livewire-select-focus-selected', ['name' => $this->name]);
            $this->emit('selected', $value);
        }

        $this->notifyValueChanged();
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
