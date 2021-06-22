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
 * @method static static FinancialStatement()
 * @method static static Contract()
 * @method static static Misc()
 */
final class DocumentType extends Enum
{
    const FinancialStatement = 1;
    const Contract = 2;
    const Misc = 3;
}
