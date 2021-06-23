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
use App\View\Components\Traits\ConfirmModelDelete;
use Illuminate\Validation\Rule;
use Livewire\Component;

class UserForm extends Component
{
    use ConfirmModelDelete;

    public User $user;

    protected $validationAttributes = [
        'user.first_name' => 'first name',
        'user.last_name' => 'last name',
        'user.email' => 'email address',
        'user.role' => 'role',
    ];

    public function mount($id = null)
    {
        $this->user = User::findOrNew($id);

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
        return view('user.user-form');
    }

    public function getRules()
    {
        return [
            'user.first_name' => ['required', 'string', 'min:2', 'max:255'],
            'user.last_name' => ['required', 'string', 'min:2', 'max:255'],
            'user.email' => [
                'required', 'string', 'email', 'min:8', 'max:255',
                $this->user->id ? Rule::unique('users', 'email')->ignore($this->user->id) : 'unique:users,email',
            ],
            'user.role' => ['required', 'int'],
            'user.status' => ['required', 'int', Rule::in([Status::Active, Status::NotActive])],
        ];
    }

    public function getDeleteModel()
    {
        return $this->user;
    }
}
