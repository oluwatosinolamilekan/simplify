<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Vendor;

use App\Models\Vendor;
use App\Models\VendorSettings;
use App\Support\Validation\ValidationRules;
use App\View\Components\Company\CompanyComponent;
use App\View\Components\Traits\ConfirmModelDelete;
use Exception;

class VendorDetails extends CompanyComponent
{
    use ConfirmModelDelete;

    public Vendor $vendor;
    public VendorSettings $settings;

    /**
     * @param  $vendor_id
     * @throws Exception
     */
    public function mount($vendor_id = null)
    {
        $this->vendor = Vendor::with([
            'company',
            'factor',
            'factor.company',
            'client',
            'client.company',
            'settings',
        ])->findOrNew($vendor_id);

        parent::mount($this->vendor->getRelatedInstanceOrNew('company'));
    }

    public function render()
    {
        return view('vendors.details');
    }

    public function initRelated()
    {
        parent::initRelated();

        $this->settings = $this->vendor->getRelatedInstanceOrNew('settings');
    }

    public function getRules()
    {
        /** Ignore vendor_id change as vendor_id is set by default */
        $this->settings->isDirty('vendor_id') && $this->settings->ignoreDirty('vendor_id');

        return ValidationRules::merge(
            parent::getRules(),
            ValidationRules::forModel('settings', $this->settings, $this->settings->isDirty())
        );
    }
}
