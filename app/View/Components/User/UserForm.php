<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\User;

use App\Enums\Role;
use App\Enums\Status;
use App\Models\User;
use App\Support\Validation\ValidationRules;
use Livewire\Component;

class UserForm extends Component
{
    public User $user;

    public function mount($user_id = null)
    {
        $this->user = User::findOrNew($user_id);

        if (! $this->user->exists) {
            $this->user->role = Role::SuperAdministrator;
            $this->user->status = Status::Active;
        }
    }

    public function save()
    {
        $this->validate();

        $this->user->save();

        $this->emit('saved');
    }

    public function render()
    {
        return view('users.form');
    }

    public function getRules()
    {
        return ValidationRules::forModel('user', $this->user)->getRules();
    }

    public function getDeleteModel()
    {
        return $this->user;
    }
}
