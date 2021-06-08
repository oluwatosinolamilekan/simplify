<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\User;

use App\Models\User;
use App\View\Components\Traits\ConfirmModelDelete;
use Livewire\Component;

class UserDetails extends Component
{
    use ConfirmModelDelete;

    public User $user;

    public function mount($id)
    {
        $this->user = User::findOrFail($id);
    }

    public function render()
    {
        return view('user.details');
    }

    public function getDeleteModel()
    {
        return $this->user;
    }
}
