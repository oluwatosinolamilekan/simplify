<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\Actions\Fortify;

use Laravel\Fortify\Rules\Password;

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array
     */
    protected function passwordRules()
    {
        // Require at least one uppercase character, one numeric character, one special character
        $password = (new Password())->requireUppercase()->requireNumeric()->requireSpecialCharacter();

        return ['required', 'string', $password, 'confirmed'];
    }
}
