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
 * @method static static CollectionFee()
 * @method static static IntervalFee()
 * @method static static FlatFee()
 * @method static static NegativeReserveFee()
 * @method static static NfeFee()
 */
final class FeeRuleType extends Enum
{
    const CollectionFee = 1;
    const IntervalFee = 2;
    const FlatFee = 3;
    const NegativeReserveFee = 4;
    const NfeFee = 5;
}
