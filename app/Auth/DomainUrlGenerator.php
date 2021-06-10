<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\Auth;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class DomainUrlGenerator
{
    public static function resetPasswordUrl($notifiable, $token)
    {
        return URL::temporarySignedRoute(
            'password.reset',
            Carbon::now()->addMinutes(Config::get('auth.passwords.expire', 60)),
            [
                'token' => $token,
                'subdomain' => $notifiable->subdomain,
                'company' => $notifiable->company->id ?? null,
                'email' => $notifiable->getEmailForPasswordReset(),
            ]
        );
    }

    public static function configurePasswordUrl($notifiable, $token)
    {
        return URL::temporarySignedRoute(
            'password.configure',
            Carbon::now()->addMinutes(Config::get('auth.passwords.expire', 60)),
            [
                'token' => $token,
                'subdomain' => $notifiable->subdomain,
                'company' => $notifiable->company->id ?? null,
                'email' => $notifiable->getEmailForConfiguration(),
            ]
        );
    }

    public static function verifyEmailUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id' => $notifiable->getKey(),
                'subdomain' => $notifiable->subdomain,
                'company' => $notifiable->company->id ?? null,
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }

    public static function redirectionUrl($user)
    {
        $url = config('app.url');
        $domain = config('app.base_domain');

        if (! $user->subdomain) {
            return $url;
        }

        return str_replace($domain, "{$user->subdomain}.{$domain}", $url);
    }
}
