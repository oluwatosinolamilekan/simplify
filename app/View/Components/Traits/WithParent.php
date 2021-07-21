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
    /**
     * Livewire "updated" hook
     * Informs parent component about property changes
     * Properties in parent and nested components need to have *exactly* the same name, otherwise values will not be synchronized.
     * @param $name
     * @param $value
     */
    public function updatedWithParent($name, $value)
    {
        // Inform parent component about the change
        $this->emitUp('update', $name, $value);
    }
}
