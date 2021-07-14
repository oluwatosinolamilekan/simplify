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
use App\View\Components\Traits\WithNested;
use DB;
use Throwable;

class ClientWizard extends CompanyComponent
{
    use ConfirmModelDelete;
    use WithNested;

    public Client $client;
    public ClientAnalysis $clientAnalysis;
    public ClientFundingInstructions $fundingInstructions;

    public function mount($client_id = null)
    {
        $this->client = Client::with([
            'company',
            'company.identity',
            'company.address',
            'company.contactDetails',
            'company.bankInformation',
            'analysis',
        ])->findOrNew($client_id);

        parent::mount($this->client->company_id);

        $this->clientAnalysis = $this->client->analysis ?? new ClientAnalysis();
        $this->fundingInstructions = $this->client->fundingInstructions ?? new ClientFundingInstructions();
    }

    public function saveClient()
    {
        $this->validate();

        // TODO @Jovana: should be separate service + reusable middlewares

        try {
            DB::beginTransaction();

            $this->company->save();

            $this->client->company()->associate($this->company);
            $this->client->save();

            if ($this->fundingInstructions->isDirty()) {
                $this->fundingInstructions->client()->associate($this->client);
                $this->fundingInstructions->save();
            }

            DB::commit();

            $this->successAlert();
        } catch (Throwable $exception) {
            DB::rollBack();
            $this->exceptionAlert($exception);
        }
    }

    public function saveContact()
    {
        $this->validate();
        try {
            DB::beginTransaction();

            $this->saveContactDetails();
            $this->saveBankInformation();

            DB::commit();

            $this->successAlert();
        } catch (Throwable $exception) {
            DB::rollBack();
            $this->exceptionAlert($exception);
        }
    }

    public function saveCredit()
    {
    }

    public function render()
    {
        return view('client.wizard');
    }

    public function getRules()
    {
        return array_merge(
            parent::getRules(),
            $this->client->getRules(),
            $this->clientAnalysis->getRules(false),
            $this->fundingInstructions->getRules(false),
        );
    }
}
