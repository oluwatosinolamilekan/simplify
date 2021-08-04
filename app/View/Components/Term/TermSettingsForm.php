<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Term;

use App\Models\TermSettings;
use App\View\Components\ModelForm;

class TermSettingsForm extends ModelForm
{
    public TermSettings $settings;

    public function mount(TermSettings $settings)
    {
        $this->settings = $settings;
    }

    public function render()
    {
        return view('terms.settings.form');
    }

    public function getProperty()
    {
        return 'settings';
    }

    /* Realtime validation */

    public function updated($property)
    {
        // if any rate has been changed - validate all rates to check sum against 100
        if (in_array($property, ['settings.advance_rate', 'settings.purchase_fee_rate', 'settings.escrow_rate'])) {
            $this->validateOnly('settings.escrow_rate');
            $this->validateOnly('settings.advance_rate');
            $this->validateOnly('settings.purchase_fee_rate');
        } else {
            $this->validateOnly($property);
        }
    }

    public function messages()
    {
        return $this->settings->getMessages();
    }
}
