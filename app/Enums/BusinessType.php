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
 * @method static static LLC()
 * @method static static SoleProprietor()
 * @method static static LimitedPartnership()
 * @method static static Corporation()
 * @method static static Other()
 */
final class BusinessType extends Enum
{
    const LLC = 1;
    const SoleProprietor = 2;
    const LimitedPartnership = 3;
    const Corporation = 4;
    const Other = 5;
}
