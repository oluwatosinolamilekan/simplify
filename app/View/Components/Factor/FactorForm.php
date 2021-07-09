<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Factor;

use App\Enums\Status;
use App\Models\Factor;
use App\View\Components\Traits\ConfirmModelDelete;
use Illuminate\Validation\Rule;
use Livewire\Component;

class FactorForm extends Component
{
    use ConfirmModelDelete;

    public Factor $factor;

    public function render()
    {
        return view('factor.form');
    }

    public function getRules()
    {
        return self::getValidationRules();
    }

    public static function getValidationRules()
    {
        return [
            'factor.ref_code' => ['required', 'string', 'min:2', 'max:125'],
            'factor.status' => ['required', 'int', Rule::in([Status::Active, Status::NotActive])],
        ];
    }
}
