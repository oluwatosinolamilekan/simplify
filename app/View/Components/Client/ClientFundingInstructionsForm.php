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
use App\View\Components\Traits\WithParent;
use Livewire\Component;

class ClientFundingInstructionsForm extends Component
{
    use WithParent;

    public ClientFundingInstructions $fundingInstructions;

    public ?string $warningNote = null;
    public ?string $fundingNote = null;

    public function mount(ClientFundingInstructions $fundingInstructions)
    {
        $this->fundingInstructions = $fundingInstructions;
    }

    public function render()
    {
        return view('client.funding-instructions-form');
    }

    public function addNote()
    {
        \Log::debug('CLICK');
    }

    public function rules()
    {
        return $this->fundingInstructions->getRules();
    }
}
