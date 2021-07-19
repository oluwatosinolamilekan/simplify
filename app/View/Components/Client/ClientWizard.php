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
use App\View\Components\Traits\WithNested;
use DB;
use Throwable;

class ClientWizard extends CompanyComponent
{
    use ConfirmModelDelete;
    use WithNested;

    public Client $client;
    public ClientAnalysis $analysis;
    public ClientCredit $credit;
    public ClientFundingInstructions $fundingInstructions;

    public function mount($client_id = null)
    {
        $this->client = Client::with([
            'analysis',
            'credit',
            'fundingInstructions',
        ])->findOrNew($client_id);

        parent::mount($this->client->company_id);

        $this->analysis = $this->client->analysis ?? new ClientAnalysis();
        $this->fundingInstructions = $this->client->fundingInstructions ?? new ClientFundingInstructions();
        $this->credit = $this->client->clientCredit ?? new ClientCredit();
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

            if ($this->credit->isDirty()) {
                $this->credit->client()->associate($this->client);
                $this->credit->save();
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

    public function render()
    {
        return view('client.wizard');
    }

    public function getRules()
    {
        return ValidationRules::merge(
            parent::getRules(),
            ValidationRules::forModel('client', $this->client),
            ValidationRules::forModel('analysis', $this->analysis, false),
            ValidationRules::forModel('credit', $this->credit, false),
            ValidationRules::forModel('fundingInstructions', $this->fundingInstructions, false),
        );
    }
}
