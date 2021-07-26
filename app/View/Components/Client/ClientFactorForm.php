<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Client;

use App\Models\Client;
use Livewire\Component;

class ClientFactorForm extends Component
{
    public Client $client;

    public function render()
    {
        return view('clients.factor-form');
    }

    public function getRules()
    {
        return [
            'client.factor_id' => ['required', 'int', 'exists:factors,id'],
        ];
    }
}
