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
 * @method static static ACH()
 * @method static static CHECK()
 * @method static static WIRE()
 */
final class PaymentMethod extends Enum
{
    const ACH = 1;
    const CHECK = 2;
    const WIRE = 3;
}
