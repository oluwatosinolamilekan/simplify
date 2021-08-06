<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Settings;

use App\View\Components\Component;

class SettingsForm extends Component
{
    public function render()
    {
        return view('settings.form');
    }
}
