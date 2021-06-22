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
 * @method static static SalesRepresentative()
 * @method static static FactorBroker()
 */
final class CommissionType extends Enum
{
    const SalesRepresentative = 1;
    const FactorBroker = 2;
}
