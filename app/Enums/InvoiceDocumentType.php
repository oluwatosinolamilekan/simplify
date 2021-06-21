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
 * @method static static Invoice()
 * @method static static FinancialStatement()
 * @method static static Other()
 */
final class InvoiceDocumentType extends Enum
{
    const Invoice = 1;
    const FinanceDocument = 2;
    const Other = 3;
}
