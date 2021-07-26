<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Vendor;

use App\Models\VendorSettings;
use App\View\Components\ModelForm;

class VendorSettingsForm extends ModelForm
{
    public VendorSettings $settings;

    public function mount(VendorSettings $settings)
    {
        $this->settings = $settings;
    }

    public function render()
    {
        return view('vendors.settings.form');
    }

    public function getProperty()
    {
        return 'settings';
    }
}
