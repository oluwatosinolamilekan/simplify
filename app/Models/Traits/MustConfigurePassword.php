<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\Models\Traits;

use App\Notifications\ConfigurePassword;
use Illuminate\Support\Facades\Password;

trait MustConfigurePassword
{
    /**
     * Determine if the user has configured their password.
     *
     * @return bool
     */
    public function hasConfiguredPassword()
    {
        return ! is_null($this->password);
    }

    /**
     * Send the password configuration notification.
     *
     * @return void
     */
    public function sendPasswordConfigurationNotification()
    {
        $broker = Password::broker(config('fortify.passwords'));

        $broker->sendResetLink(
            ['email' => $this->getEmailForConfiguration()],
            function ($user, $token) {
                $user->notify(new ConfigurePassword($token));
            }
        );
    }

    /**
     * Get the email address that should be used for password configuration.
     *
     * @return string
     */
    public function getEmailForConfiguration()
    {
        return $this->email;
    }
}
