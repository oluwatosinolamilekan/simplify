<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\UserCompanyAccess;

use App\Enums\Status;
use App\Models\UserCompanyAccess;
use Illuminate\Validation\Rule;
use Livewire\Component;

class UserCompanyAccessForm extends Component
{
    public UserCompanyAccess $userCompanyAccess;

    public function render()
    {
        return view('user-company-access.form');
    }

    public function getRules()
    {
        return self::getValidationRules();
    }

    public static function getValidationRules()
    {
        return [
            'userCompanyAccess.first_name' => ['required', 'string', 'min:2', 'max:255'],
            'userCompanyAccess.last_name' => ['required', 'string', 'min:2', 'max:255'],
            'userCompanyAccess.middle_name' => ['string', 'min:2', 'max:255'],
            'userCompanyAccess.role' => ['required', 'int'],
            'userCompanyAccess.status' => ['required', 'int', Rule::in([Status::Active, Status::NotActive])],
        ];
    }
}
