<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\Enums;

class StatusTypesList
{
    public const Default = [
        Status::NotActive,
        Status::Active,
        Status::Deleted,
    ];

    public const User = [
        Status::Active,
        Status::NotActive,
    ];

    public const UserCompanyAccess = [
        Status::Active,
        Status::NotActive,
    ];

    public const Invoices = [
        Status::Requested,
        Status::Approved,
        Status::Suspended,
        Status::Funded,
    ];

    public const Payments = [
        Status::Draft,
        Status::Authorized,
        Status::Unapplied,
        Status::Suspended,
        Status::Deleted,
        Status::Refunded,
    ];

    public const Factor = [
        Status::Active,
        Status::NotActive,
    ];

    public const Client = [
        Status::Active,
        Status::NotActive,
    ];

    public const Vendor = [
        Status::Active,
        Status::NotActive,
    ];

    public const Debtor = [
        Status::Active,
        Status::NotActive,
    ];

    public const Term = [
        Status::Active,
        Status::NotActive,
    ];
}
