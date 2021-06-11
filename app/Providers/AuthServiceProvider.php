<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\Providers;

use App\Auth\DomainSessionGuard;
use App\Auth\DomainUrlGenerator;
use App\Notifications\ConfigurePassword;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerPolicies();
        $this->registerGuards();
        $this->registerCallbacks();
    }

    public function registerGuards()
    {
        Auth::extend('domain-session', function ($app, $name, array $config) {
            $guard = new DomainSessionGuard($name, Auth::createUserProvider($config['provider']), $app['session.store']);

            // When using the remember me functionality of the authentication services we
            // will need to be set the encryption instance of the guard, which allows
            // secure, encrypted cookie values to get generated for those cookies.
            $guard->setCookieJar($app['cookie']);
            $guard->setDispatcher($app['events']);
            $guard->setRequest($app->refresh('request', $guard, 'setRequest'));

            return $guard;
        });
    }

    public function registerCallbacks()
    {
        VerifyEmail::createUrlUsing(fn ($notifiable) => DomainUrlGenerator::verifyEmailUrl($notifiable));
        ConfigurePassword::createUrlUsing(fn ($notifiable, $token) => DomainUrlGenerator::configurePasswordUrl($notifiable, $token));
        ResetPassword::createUrlUsing(fn ($notifiable, $token) => DomainUrlGenerator::resetPasswordUrl($notifiable, $token));
    }
}
