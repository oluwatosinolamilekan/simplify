<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\Actions\Fortify;

use App\Auth\DomainSessionGuard;
use Illuminate\Http\RedirectResponse;
use Laravel\Fortify\Actions\AttemptToAuthenticate as Base;

class AttemptToAuthenticate extends Base
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  callable  $next
     * @return mixed
     */
    public function handle($request, $next)
    {
        if ($this->guard instanceof DomainSessionGuard) {
            return $this->handleForDomain($request, $next);
        }

        return parent::handle($request, $next);
    }

    public function handleForDomain($request, $next)
    {
        if ($response = $this->guard->attemptForDomain($request)) {
            return $response instanceof RedirectResponse ? $response : $next($request);
        }

        $this->throwFailedAuthenticationException($request);

        return false;
    }
}
