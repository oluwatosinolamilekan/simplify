<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\Enums;

class RoleTypesList
{
    public const System = [
        Role::SuperAdministrator,
        Role::Administrator,
    ];

    public const Company = [
        Role::AccountExecutive,
        Role::SalesRepresentative,
        Role::FactorBroker,
    ];
}
