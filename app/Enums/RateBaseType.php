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
 * @method static static AdvanceAmount()
 * @method static static InvoiceAmount()
 */
final class RateBaseType extends Enum
{
    const AdvanceAmount = 1;
    const InvoiceAmount = 2;
}
