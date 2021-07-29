<?php

namespace App\View\Components;

use Asantibanez\LivewireSelect\LivewireSelect;

class SearchableSelect extends LivewireSelect
{

    public function render()
    {
        return view('searchable-select');
    }
}
