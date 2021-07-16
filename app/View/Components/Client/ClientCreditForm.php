<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Client;

use App\Models\ClientCredit;
use Livewire\Component;

class ClientCreditForm extends Component
{
    public ClientCredit $clientCredit;

    public function render()
    {
        return view('client.credit-form');
    }

    public function getRules()
    {
        return $this->clientCredit->getRules();
    }
}
