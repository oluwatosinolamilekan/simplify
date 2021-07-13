<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Client;

use App\Enums\BusinessType;
use App\Models\ClientAnalysis;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ClientAnalysisForm extends Component
{
    public ClientAnalysis $clientAnalysis;

    public function render()
    {
        return view('client.analysis-form');
    }

    public function getRules()
    {
        return $this->clientAnalysis->getRules();
    }
}
