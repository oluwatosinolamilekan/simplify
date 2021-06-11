<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\Http\Middleware;

use App\Models\Company;
use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class DomainRouting
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $this->resolveDomain($request);

        return $next($request);
    }

    public function resolveDomain(Request $request)
    {
        $host = $request->getHost();
        $base = $this->getBaseHost();

        $subdomain = explode(".{$base}", $host)[0];

        if ($subdomain == $base) {
            return;
        }

        try {
            $company = Company::active()->where('domain', $subdomain)->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }

        $request->merge([
            'subdomain' => $subdomain,
            'company' => $company->id,
        ]);
    }

    public function getBaseHost()
    {
        return config('app.base_domain');
    }
}
