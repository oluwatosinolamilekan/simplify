<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Traits;

trait WithParent
{
    public function updatedWithParent($name, $value)
    {
        // Realtime validation
        $this->validateOnly($name);

        // Inform parent component about the change
        $this->emitUp('update', $name, $value);
    }
}
