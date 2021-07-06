<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Company\User;

use App\Models\UserCompanyAccess;
use App\View\Components\Traits\ConfirmModelDelete;
use Livewire\Component;

class CompanyUserDetails extends Component
{
    use ConfirmModelDelete;

    public UserCompanyAccess $userCompanyAccess;

    public function mount($company_id, $user_id)
    {
        $this->userCompanyAccess = UserCompanyAccess::where(['company_id' => $company_id, 'user_id' => $user_id])->firstOrFail();
    }

    public function render()
    {
        return view('company.user.details');
    }

    public function getDeleteModel()
    {
        return $this->userCompanyAccess;
    }
}
