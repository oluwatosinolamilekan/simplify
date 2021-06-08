<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Controllers\NewPasswordController;
use Laravel\Fortify\Http\Responses\SimpleViewResponse;

class PasswordController extends NewPasswordController
{
    /**
     * Show the account configuration view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return SimpleViewResponse
     */
    public function configure(Request $request): SimpleViewResponse
    {
        return new SimpleViewResponse('auth/password-configure');
    }

    /**
     * Reset the user's password.
     *
     * @param  Request  $request
     * @return Responsable
     */
    public function store(Request $request): Responsable
    {
        $credentials = $request->only(Fortify::email(), 'password', 'password_confirmation', 'token');

        if (! is_null($user = $this->broker()->getUser($credentials))) {
            if ($user instanceof MustVerifyEmail && ! $user->hasVerifiedEmail()) {
                $user->markEmailAsVerified();
            }
        }

        return parent::store($request);
    }
}
