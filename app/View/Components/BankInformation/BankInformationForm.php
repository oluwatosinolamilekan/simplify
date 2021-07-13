<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\BankInformation;

use App\Models\BankInformation;
use Illuminate\Validation\Rule;
use Livewire\Component;

class BankInformationForm extends Component
{
    public BankInformation $bankInformation;

    public function render()
    {
        return view('bank-information.form');
    }

    public static function getValidationRules(BankInformation $model = null)
    {
        $dirty = $model && $model->isDirty();

        return [
            'bankInformation.bank_name' => [Rule::requiredIf($dirty), 'string', 'min:2', 'max:255'],
            'bankInformation.account_holder_name' => [Rule::requiredIf($dirty), 'string', 'min:2', 'max:125'],
            'bankInformation.account_number' => [Rule::requiredIf($dirty), 'string', 'min:2', 'max:125'],
            'bankInformation.routing_number' => [Rule::requiredIf($dirty), 'string', 'min:2', 'max:125'],
            'bankInformation.swift_code' => [Rule::requiredIf($dirty), 'string', 'min:2', 'max:125'],
        ];
    }

    public function getRules()
    {
        return $this->bankInformation->getRules();
    }
}
