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
use DB;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Throwable;

/**
 * Class ClientWizard.
 */
class ClientWizard extends CompanyComponent
{
    public Client $client;
    public ClientAnalysis $analysis;
    public ClientCredit $credit;
    public ClientFundingInstructions $fundingInstructions;

    /**
     * @param  $client_id
     * @throws Exception
     */
    public function mount($client_id = null)
    {
        $this->client = Client::with([
            'company',
            'analysis',
            'credit',
            'fundingInstructions',
        ])->findOrNew($client_id);

        parent::mount($this->client->getRelatedInstanceOrNew('company'));
    }

    /**
     * @throws Exception
     */
    public function save()
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

        $this->initRelated();
    }

    /**
     * @throws Exception
     */
    public function initRelated()
    {
        parent::initRelated();

        $this->analysis = $this->client->getRelatedInstanceOrNew('analysis');
        $this->credit = $this->client->getRelatedInstanceOrNew('credit', true);
        $this->fundingInstructions = $this->client->getRelatedInstanceOrNew('fundingInstructions', true);
    }

    /**
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('clients.wizard');
    }

    /**
     * @return array
     */
    public function getRules()
    {
        /** Ignore client_id change as client_id is set by default */
        $this->fundingInstructions->isDirty('client_id') && $this->fundingInstructions->ignoreDirty('client_id');
        $this->credit->isDirty('client_id') && $this->credit->ignoreDirty('client_id');

        return ValidationRules::merge(
            ValidationRules::forModel('company', $this->company),
            ValidationRules::forModel('client', $this->client),
            ValidationRules::forModel('credit', $this->credit, $this->credit->isDirty()),
            ValidationRules::forModel('fundingInstructions', $this->fundingInstructions, $this->fundingInstructions->isDirty())
        );
    }
}
