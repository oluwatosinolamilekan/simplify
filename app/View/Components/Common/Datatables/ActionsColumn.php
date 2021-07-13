<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Common\Datatables;

use Mediconesystems\LivewireDatatables\Column;

class ActionsColumn extends Column
{
    public static function actions($columns, $callback, $params = [])
    {
        $column = self::callback($columns, $callback, $params);

        $column->type = 'actions';

        return $column;
    }
}
