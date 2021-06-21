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
 * @method static static CalendarDays()
 * @method static static MondayFriday()
 * @method static static BusinessDays()
 */
final class FloatDaysType extends Enum
{
    const CalendarDays = 1;
    const MondayFriday = 2;
    const BusinessDays = 3;
}
