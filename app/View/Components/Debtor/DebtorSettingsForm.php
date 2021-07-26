<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Debtor;

use App\Models\DebtorSettings;
use App\View\Components\ModelForm;

class DebtorSettingsForm extends ModelForm
{
    public DebtorSettings $settings;

    public ?string $warningNote = null;

    public function mount(DebtorSettings $settings)
    {
        $this->settings = $settings;
    }

    public function render()
    {
        return view('debtors.settings.form');
    }

    public function getProperty()
    {
        return 'settings';
    }
}
