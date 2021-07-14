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
use App\Models\ClientAnalysis;
use App\Models\ClientFundingInstructions;
use App\View\Components\Company\CompanyComponent;
use App\View\Components\Traits\ConfirmModelDelete;

class ClientDetails extends CompanyComponent
{
    use ConfirmModelDelete;

    public Client $client;
    public ClientAnalysis $clientAnalysis;
    public ClientFundingInstructions $fundingInstructions;

    public function mount($client_id)
    {
        $this->client = Client::with(['analysis', 'fundingInstructions'])->findOrNew($client_id);

        parent::mount($this->client->company_id);

        $this->clientAnalysis = $this->client->analysis ?? new ClientAnalysis();
        $this->fundingInstructions = $this->client->fundingInstructions ?? new ClientFundingInstructions();
    }

    public function render()
    {
        return view('client.details');
    }

    public function getRules()
    {
        return array_merge(
            parent::getRules(),
            $this->clientAnalysis->getRules(false),
            $this->fundingInstructions->getRules(false)
        );
    }
}
