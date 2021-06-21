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
 * @method static static InvoiceBased()
 * @method static static ScheduleBased()
 * @method static static Other()
 */
final class TermType extends Enum
{
    const InvoiceBased = 1;
    const ScheduleBased = 2;
    const Other = 3;
}
