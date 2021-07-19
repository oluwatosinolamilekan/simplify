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
use App\Models\ClientCredit;
use App\Models\ClientFundingInstructions;
use App\Support\Validation\ValidationRules;
use App\View\Components\Company\CompanyComponent;
use App\View\Components\Traits\ConfirmModelDelete;

class ClientDetails extends CompanyComponent
{
    use ConfirmModelDelete;

    public Client $client;
    public ClientAnalysis $clientAnalysis;
    public ClientFundingInstructions $fundingInstructions;
    public ClientCredit $clientCredit;

    public function mount($client_id)
    {
        $this->client = Client::with([
            'analysis',
            'credit',
            'fundingInstructions',
        ])->findOrFail($client_id);

        parent::mount($this->client->company_id);

        $this->clientAnalysis = $this->client->analysis ?? new ClientAnalysis();
        $this->fundingInstructions = $this->client->fundingInstructions ?? new ClientFundingInstructions();
        $this->clientCredit = $this->client->clientCredit ?? new ClientCredit();
    }

    public function render()
    {
        return view('client.details');
    }

    public function getRules()
    {
        return ValidationRules::merge(
            parent::getRules(),
            ValidationRules::forModel('client', $this->client),
            ValidationRules::forModel('clientAnalysis', $this->clientAnalysis, false),
            ValidationRules::forModel('clientCredit', $this->clientCredit, false),
            ValidationRules::forModel('fundingInstructions', $this->fundingInstructions, false),
        );
    }
}
