<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Debtor;

use App\Models\Debtor;
use App\Models\DebtorSettings;
use App\Support\Validation\ValidationRules;
use App\View\Components\Company\CompanyComponent;
use App\View\Components\Traits\ConfirmModelDelete;
use Exception;

class DebtorDetails extends CompanyComponent
{
    use ConfirmModelDelete;

    public Debtor $debtor;
    public DebtorSettings $settings;

    /**
     * @param  $debtor_id
     * @throws Exception
     */
    public function mount($debtor_id = null)
    {
        $this->debtor = Debtor::with([
            'company',
            'factor',
            'factor.company',
            'client',
            'client.company',
            'settings',
            'credit',
            'creditLimit',
        ])->findOrNew($debtor_id);

        parent::mount($this->debtor->getRelatedInstanceOrNew('company'));
    }

    public function render()
    {
        return view('debtors.details');
    }

    /**
     * @throws Exception
     */
    public function initRelated()
    {
        parent::initRelated();

        $this->settings = $this->debtor->getRelatedInstanceOrNew('settings');
    }

    public function getRules()
    {
        /** Ignore debtor_id change as debtor_id is set by default */
        $this->settings->isDirty('debtor_id') && $this->settings->ignoreDirty('debtor_id');

        return ValidationRules::merge(
            parent::getRules(),
            ValidationRules::forModel('debtor', $this->debtor),
            ValidationRules::forModel('settings', $this->settings, $this->settings->isDirty())
        );
    }
}
