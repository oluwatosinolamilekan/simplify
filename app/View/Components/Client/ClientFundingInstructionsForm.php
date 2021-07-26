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

    public ?string $warningNote = null;

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
}
