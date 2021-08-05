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
use App\Models\Company;
use App\Models\User;
use App\Models\UserCompanyAccess;
use App\Support\Validation\ValidationRules;
use App\View\Components\ModelForm;
use App\View\Components\Traits\ConfirmModelDelete;
use DB;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Throwable;

class CompanyUserForm extends ModelForm
{
    use ConfirmModelDelete;

    public UserCompanyAccess $userCompanyAccess;
    public User $user;

    /** @var string[] Custom validation messages */
    protected array $messages = [
        'userCompanyAccess.user_id.unique' => 'User with given email is already registered for this company.',
        'userCompanyAccess.company_id.unique' => 'User with given email is already registered for this company.',
    ];

    /** Mount with variadic arguments to support mounting with both ids and models.
     * @param array $params
     * @throws Exception
     */
    public function mount(...$params)
    {
        [$company, $user] = [$params[0], $params[1] ?? null];

        $attributes = ['company_id' => $company, 'user_id' => $user];

        if ($company instanceof Company) {
            $attributes['company_id'] = $company->id;
        }

        if ($user instanceof User) {
            $attributes['user_id'] = $user->id;
        }

        $this->userCompanyAccess = UserCompanyAccess::with('user')->firstOrNew($attributes);

        $this->userCompanyAccess->syncOriginal();

        $this->user = $this->userCompanyAccess->getRelatedInstanceOrNew('user');
    }

    /**
     * On user email update, check if user with given email already exists and link it with company
     * Email update is allowed only in "create" scenario.
     * @throws ValidationException
     */
    public function updatedUserEmail()
    {
        /* If user is fresh new record ("create" scenario) - try to find user with given email first */
        if (! $this->userCompanyAccess->exists) {
            $this->user = User::firstOrNew(['email' => $this->user->email], ['role' => Role::CompanyUser]);
            $this->userCompanyAccess->user()->associate($this->user); // for validation purposes

            $this->validateOnly('userCompanyAccess.user_id');
        }
    }

    /**
     * Save action.
     */
    public function save()
    {
        $this->validate();

        // TODO @Jovana: move this to service + middlewares
        try {
            DB::beginTransaction();

            $this->user->save();

            $this->userCompanyAccess->user()->associate($this->user);
            $this->userCompanyAccess->save();

            DB::commit();

            $this->successAlert();

            if (! $this->nested) {
                $this->redirect(route('companies.users.view', [
                    'company_id' => $this->userCompanyAccess->company_id,
                    'user_id' => $this->user->id,
                ]));
            } else {
                $this->emitUp('saved', $this->getProperty(), $this->userCompanyAccess->id);
                if ($this->nested) {
                    $this->mount($this->userCompanyAccess->company_id);
                }
            }
        } catch (Throwable $exception) {
            $this->exceptionAlert($exception);
        }
    }

    /**
     * @return Application|Factory|View|mixed
     */
    public function render()
    {
        return view('companies.user.form');
    }

    /**
     * @return array
     */
    public function getRules()
    {
        /*
         * Email uniqueness should not be validated
         * If user with given email address exists - company access is granted for that user
         * Email address update is not allowed
         */

        $userRules = $this->user->getRules();
        $userRules['email'] = ['required', 'string', 'email', 'min:8', 'max:255'];

        return ValidationRules::merge(
            ValidationRules::forModel('userCompanyAccess', $this->userCompanyAccess),
            ValidationRules::forProperty('user', $userRules)
        );
    }

    /**
     * @return mixed|string
     */
    public function getProperty()
    {
        return 'userCompanyAccess';
    }
}
