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
use DB;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Throwable;

/**
 * Class VendorWizard.
 */
class VendorWizard extends CompanyComponent
{
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

    /**
     * @throws Exception
     */
    public function save()
    {
        $this->vendor->getRelatedInstanceOrNew('client', true);
        $this->vendor->factor_id = $this->vendor->client->factor_id;

        $this->validate();

        // TODO @Jovana: should be separate service + reusable middlewares

        try {
            DB::beginTransaction();

            $this->company->save();

            $this->vendor->company()->associate($this->company);
            $this->vendor->save();

            if ($this->settings->isDirty()) {
                $this->settings->vendor()->associate($this->vendor);
                $this->settings->save();
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

        $this->settings = $this->vendor->getRelatedInstanceOrNew('settings', true);
    }

    /**
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('vendors.wizard');
    }

    /**
     * @return array
     */
    public function getRules()
    {
        /** Ignore vendor_id change as vendor_id is set by default */
        $this->settings->isDirty('vendor_id') && $this->settings->ignoreDirty('vendor_id');

        return ValidationRules::merge(
            ValidationRules::forModel('company', $this->company),
            ValidationRules::forModel('vendor', $this->vendor),
            ValidationRules::forModel('settings', $this->settings, $this->settings->isDirty())
        );
    }
}
