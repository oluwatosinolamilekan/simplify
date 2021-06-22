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
 * @method static static SuperAdministrator()
 * @method static static Administrator()
 * @method static static AccountExecutive()
 * @method static static SalesRepresentative()
 * @method static static FactorBroker()
 */
final class Role extends Enum
{
    const SuperAdministrator = 1;
    const Administrator = 2;
    const AccountExecutive = 3;
    const SalesRepresentative = 4;
    const FactorBroker = 5;
}
