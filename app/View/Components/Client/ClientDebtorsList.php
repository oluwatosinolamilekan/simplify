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
use App\View\Components\Debtor\DebtorsList;
use Arr;

class ClientDebtorsList extends DebtorsList
{
    public Client $client;

    public function builder()
    {
        return parent::builder()->where('client_id', $this->client->id);
    }

    public function columns()
    {
        return Arr::where(parent::columns(), fn ($column) => ! in_array($column->name, ['client.company.name', 'factor.company.name']));
    }
}
