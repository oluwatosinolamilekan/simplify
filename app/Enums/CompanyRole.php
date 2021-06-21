<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Owner()
 * @method static static Employee()
 * @method static static Other()
 */
final class CompanyRole extends Enum
{
    const Owner = 1;
    const Employee = 2;
    const Other = 3;
}
