<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Company\User;

use App\Enums\Role;
use App\Enums\RoleTypesList;
use App\Enums\Status;
use App\Models\User;
use App\Models\UserCompanyAccess;
use App\View\Components\Traits\ConfirmModelDelete;
use DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Throwable;

class CompanyUserForm extends Component
{
    use ConfirmModelDelete;

    public UserCompanyAccess $userCompanyAccess;
    public User $user;

    public $roles = RoleTypesList::Company; // allowed roles

    public function mount(int $company_id, int $user_id = null)
    {
        $attributes = ['company_id' => $company_id, 'user_id' => $user_id];

        $this->userCompanyAccess = UserCompanyAccess::firstOrNew($attributes);

        $this->user = $this->userCompanyAccess->user ?? new User(['role' => Role::CompanyUser]);
    }

    public function save()
    {
        $this->validate();

        // TODO @Jovana: move this to service + middlewares
        try {
            DB::beginTransaction();

            /* If user is fresh new record ("create" scenario) - try to find user with given email first */
            if (! $this->user->exists) {
                $this->user = User::firstOrNew(['email' => $this->user->email], ['role' => Role::CompanyUser]);
                $this->user->save();
                $this->userCompanyAccess->user()->associate($this->user);
            }

            $this->userCompanyAccess->save();

            DB::commit();

            $this->emit('saved');
        } catch (Throwable $exception) {
            $this->exceptionAlert($exception);
        }
    }

    public function render()
    {
        return view('company.user.form');
    }

    public function getRules()
    {
        return self::getValidationRules($this->user);
    }

    public static function getValidationRules($user = null)
    {
        // TODO @Jovana: try move all validation rules to models
        return [
            'userCompanyAccess.company_id' => ['required', 'int'],
            'userCompanyAccess.first_name' => ['required', 'string', 'min:2', 'max:255'],
            'userCompanyAccess.last_name' => ['required', 'string', 'min:2', 'max:255'],
            'userCompanyAccess.middle_name' => ['string', 'min:2', 'max:255'],
            'userCompanyAccess.role' => ['required', 'int'],
            'userCompanyAccess.status' => ['required', 'int', Rule::in([Status::Active, Status::NotActive])],
            'userCompanyAccess.emails' => ['array'],
            'userCompanyAccess.emails.*' => ['string', 'email', 'min:8', 'max:255'],
            'userCompanyAccess.phone_numbers' => ['array'],
            'userCompanyAccess.phone_numbers.*' => ['string', 'phone_number:15'],
            /*
             * Email uniqueness should not be validated
             * If user with given email address exists - company access is granted for that user
             * Email address update is not allowed
             */

            'user.email' => ['required', 'string', 'email', 'min:8', 'max:255'],
            'user.role' => [Rule::requiredIf(! isset($user) || ! $user->exists), 'int'],
        ];
    }
}
