<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Factor;

use App\Models\Factor;
use Livewire\Component;

class FactorForm extends Component
{
    public Factor $factor;

    public function render()
    {
        return view('factors.relation-form');
    }

    public function getRules()
    {
        return $this->factor->getRules();
    }
}
