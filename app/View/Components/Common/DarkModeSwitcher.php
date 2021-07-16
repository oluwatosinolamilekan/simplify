<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Common;

use Auth;
use Livewire\Component;

class DarkModeSwitcher extends Component
{
    public bool $enabled;

    public function render()
    {
        return view('components.dark-mode-switcher');
    }

    public function mount()
    {
        $this->enabled = Auth::user()->getMeta('preferences.dark_mode', false);
    }

    public function toggle()
    {
        $this->enabled = ! $this->enabled;

        Auth::user()->updateMeta('preferences.dark_mode', $this->enabled);
        /*$meta['preferences'] = array_merge($meta['preferences'] ?? [], ['dark_mode' => $this->enabled]);

        Auth::user()->update(['meta' => $meta]);*/
    }
}
