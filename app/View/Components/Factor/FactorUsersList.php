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
use App\View\Components\User\UsersList;

class FactorUsersList extends UsersList
{
    public Factor $factor;

    public function builder()
    {
        return $this->factor->company->users()->getQuery();
    }
}
