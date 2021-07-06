<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Client;

use App\Enums\ClientType;
use App\Enums\Status;
use App\Models\Client;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ClientForm extends Component
{
    public Client $client;

    public function render()
    {
        return view('client.relation-form');
    }

    public function getRules()
    {
        return self::getValidationRules();
    }

    public static function getValidationRules()
    {
        return [
            'client.ref_code' => ['required', 'string', 'min:2', 'max:125'],
            'client.status' => ['required', 'int', Rule::in([Status::Active, Status::NotActive])],
            'client.type' => ['required', 'int', Rule::in(ClientType::getValues())],
        ];
    }
}
