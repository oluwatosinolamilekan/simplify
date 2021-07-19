<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Common;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Tabs extends Component
{
    public $tabs;

    public $count = 0;

    public $selected;

    public $tabshow = [];

    public $align;

    public $axis;

    public $type;

    /**
     * Construct.
     *
     * @param string $tabs
     * @param string $selected
     * @param string $align
     * @param string $axis
     */
    public function __construct(
        $tabs = '',
        $selected = '',
        $align = 'start',
        $axis = 'x'
    ) {
        $json = preg_replace('/\r|\n/', '', trim($tabs));
        $this->tabs = json_decode($json, true);
        $this->count = count($this->tabs);
        $this->align = $align;
        $this->axis = $axis;

        foreach ($this->tabs as $id => $tab) {
            $this->tabshow[$id] = false;
        }

        if ($this->count > 0) {
            $stab = ($selected == '') ? key($this->tabs) : $selected;
            $this->tabshow[$stab] = true;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.tabs');
    }
}
