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
 * @method static static Active()
 * @method static static NotActive()
 */
final class Status extends Enum
{
    const Active = 1;
    const NotActive = 2;
    const Deleted = 3;
    const Suspended = 4;

    const Requested = 5;
    const Approved = 6;
    const Funded = 7;

    const Draft = 8;
    const Authorized = 9;
    const Unapplied = 10;
    const Refunded = 11;
}
