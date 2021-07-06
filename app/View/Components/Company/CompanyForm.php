<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Company;

use App\Models\Company;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CompanyForm extends Component
{
    public Company $company;

    public function render()
    {
        return view('company.company-form');
    }

    public static function getValidationRules(Company $model = null)
    {
        return [
            'company.name' => ['required', 'string', 'min:2', 'max:255'],
            'company.domain' => ['required', 'string', 'min:2', 'max:125',
                $model && $model->id ? Rule::unique('companies', 'domain')->ignore($model->id) : 'unique:companies,domain',
            ],

        ];
    }

    public function getRules()
    {
        return self::getValidationRules($this->company);
    }
}
