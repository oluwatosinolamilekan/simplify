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
use Illuminate\Validation\Rule;
use Livewire\Component;

class CompanyIdentityForm extends Component
{
    public CompanyIdentity $companyIdentity;

    public function render()
    {
        return view('company.identity.form');
    }

    public static function getValidationRules(?CompanyIdentity $model = null)
    {
        $dirty = $model && $model->isDirty();

        return [
            'companyIdentity.company_code' => ['string', 'min:2', 'max:255', 'unique:company_identities,company_code'],
            'companyIdentity.alternate_name' => ['string', 'min:2', 'max:255'],
            'companyIdentity.mc_number' => [Rule::requiredIf($dirty), 'string', 'min:2', 'max:125'],
            'companyIdentity.dot_number' => [Rule::requiredIf($dirty), 'string', 'min:2', 'max:125'],
            'companyIdentity.fed_tax_id' => ['string', 'min:2', 'max:125'],
            'companyIdentity.duns_id' => ['string', 'min:2', 'max:125'],
            'companyIdentity.edi_id' => ['string', 'min:2', 'max:125'],
        ];
    }

    public function getRules()
    {
        return self::getValidationRules();
    }
}
