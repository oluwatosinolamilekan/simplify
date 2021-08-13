<?php

namespace App\View\Components;

use Asantibanez\LivewireSelect\LivewireSelect;
use Illuminate\Support\Collection;

class OnchangeSelect extends LivewireSelect
{
    public $selectOptions;
    public $wire;
    public $selected;

    protected $listeners = [
        'selected' => 'selectedItem',
    ];

    public function selectedItem($object)
    {
        $this->selected = $object['value'];
    }

    public function options($searchTerm = null): Collection
    {
        if (empty($searchTerm)) {
            return $this->selectOptions;
        }

        return $this->selectOptions
            ->filter(fn ($item) => str_contains(strtolower($item['description']), strtolower($searchTerm)));
    }
    public function render()
    {
        return view('onchange-select');
    }
}
