<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Factor;

use App\Models\Factor;
use App\View\Components\Vendor\VendorsList;

class FactorVendorsList extends VendorsList
{
    public Factor $factor;

    public function builder()
    {
        return parent::builder()->where('vendors.factor_id', $this->factor->id);
    }
}
