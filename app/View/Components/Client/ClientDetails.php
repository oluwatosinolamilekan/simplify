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
    public ClientAnalysis $analysis;
    public ClientFundingInstructions $fundingInstructions;
    public ClientCredit $credit;

    public function mount($client_id)
    {
        $this->client = Client::with([
            'company',
            'analysis',
            'credit',
            'fundingInstructions',
        ])->findOrFail($client_id);

        parent::mount($this->client->getRelatedInstanceOrNew('company'));
    }

    public function render()
    {
        return view('clients.details');
    }

    public function initRelated()
    {
        parent::initRelated();

        $this->analysis = $this->client->getRelatedInstanceOrNew('analysis');
        $this->credit = $this->client->getRelatedInstanceOrNew('credit');
        $this->fundingInstructions = $this->client->getRelatedInstanceOrNew('fundingInstructions');
    }

    public function getRules()
    {
        /** Ignore client_id change as client_id is set by default */
        $this->fundingInstructions->isDirty('client_id') && $this->fundingInstructions->ignoreDirty('client_id');
        $this->credit->isDirty('client_id') && $this->credit->ignoreDirty('client_id');

        return ValidationRules::merge(
            parent::getRules(),
            ValidationRules::forModel('client', $this->client),
            ValidationRules::forModel('credit', $this->credit, false),
            ValidationRules::forModel('fundingInstructions', $this->fundingInstructions, false),
            ValidationRules::forModel('analysis', $this->analysis, false),
        );
    }
}
