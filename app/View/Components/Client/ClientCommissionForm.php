<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Client;

use App\Enums\BusinessType;
use App\Models\ClientAnalysis;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ClientCommissionForm extends Component
{
    public ClientAnalysis $clientAnalysis;

    public function render()
    {
        return view('client.analysis-form');
    }

    public static function getValidationRules(?ClientAnalysis $model = null)
    {
        $dirty = $model && $model->isDirty();

        return [
            'clientAnalysis.industry' => [Rule::requiredIf($dirty), 'string', 'min:2', 'max:255'],
            'clientAnalysis.region' => [Rule::requiredIf($dirty), 'string', 'min:2', 'max:255'],
            'clientAnalysis.loan_grade' => [Rule::requiredIf($dirty), 'string', 'min:2', 'max:255'],
            'clientAnalysis.business_type' => [Rule::requiredIf($dirty), 'required', 'int', Rule::in(BusinessType::getValues())],
        ];
    }

    public function getRules()
    {
        return self::getValidationRules();
    }
}
