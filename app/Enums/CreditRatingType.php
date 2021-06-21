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
 * @method static static Ansonia()
 * @method static static Experian()
 * @method static static SR()
 */
final class CreditRatingType extends Enum
{
    const Ansonia = 1;
    const Experian = 2;
    const SR = 3;
    const Other = 3;
}
