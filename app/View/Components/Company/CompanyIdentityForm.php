<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Company;

use App\Models\CompanyIdentity;
use Livewire\Component;

class CompanyIdentityForm extends Component
{
    public CompanyIdentity $companyIdentity;

    public function render()
    {
        return view('company.identity.form');
    }

    public function getRules()
    {
        return $this->companyIdentity->getRules();
    }
}
