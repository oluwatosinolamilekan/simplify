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
}
