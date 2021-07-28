<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Client;

use App\Models\ClientFundingInstructions;
use App\View\Components\ModelForm;

class ClientFundingInstructionsForm extends ModelForm
{
    public ClientFundingInstructions $fundingInstructions;

    public ?string $note = null;

    public function mount(ClientFundingInstructions $fundingInstructions)
    {
        $this->fundingInstructions = $fundingInstructions;
    }

    public function render()
    {
        return view('clients.funding-instructions.form');
    }

    public function getProperty()
    {
        return 'fundingInstructions';
    }

    public function addNote()
    {
        $this->validateOnly('note', ['note' => $this->getRules()['fundingInstructions.warning_notes.*']]);

        $this->fundingInstructions->appendToJson('warning_notes', $this->note);

        $this->updatedWithParent('fundingInstructions.warning_notes', $this->fundingInstructions->warning_notes); // inform parent about update

        $this->note = '';
    }

    public function deleteNote($index)
    {
        $this->fundingInstructions->removeJsonField('warning_notes', $index, true);

        $this->updatedWithParent('fundingInstructions.warning_notes', $this->fundingInstructions->warning_notes); // inform parent about update
    }
}
