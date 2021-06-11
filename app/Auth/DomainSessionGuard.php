<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\Auth;

use Illuminate\Auth\SessionGuard;
use Laravel\Fortify\Fortify;

class DomainSessionGuard extends SessionGuard
{
    /**
     * Attempt to authenticate a user using the given credentials.
     *
     * @param $request
     * @return mixed
     */
    public function attemptForDomain($request)
    {
        $credentials = $request->only(Fortify::username(), 'password');
        $remember = $request->filled('remember');

        $this->fireAttemptEvent($credentials, $remember);

        $this->lastAttempted = $user = $this->provider->retrieveByCredentials($credentials);

        if (! $this->hasValidSubdomain($user, $request)) {
            $this->fireFailedEvent($user, $credentials);

            return $this->getRedirectResponse($user);
        }

        // If an implementation of UserInterface was returned, we'll ask the provider
        // to validate the user against the given credentials, and if they are in
        // fact valid we'll log the users into the application and return true.
        if ($this->hasValidCredentials($user, $credentials)) {
            $this->login($user, $remember);

            return true;
        }

        // If the authentication attempt fails we will fire an event so that the user
        // may be notified of any suspicious attempts to access their account from
        // an unrecognized user. A developer may listen to this event as needed.
        $this->fireFailedEvent($user, $credentials);

        return false;
    }

    public function hasValidSubdomain($user, $request)
    {
        return $user->subdomain === $request->subdomain;
    }

    public function getRedirectResponse($user)
    {
        return redirect()->to(DomainUrlGenerator::redirectionUrl($user));
    }
}
