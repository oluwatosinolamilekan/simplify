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
use App\View\Components\Common\Datatables\ActionsColumn;
use App\View\Components\Common\Datatables\Datatable;
use App\View\Components\Traits\ConfirmModelDelete;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;

class UsersList extends Datatable
{
    use ConfirmModelDelete;

    public $hideable = 'select';
    public $exportable = true;
    public $user = null;

    public function render()
    {
        return view('user.list');
    }

    public function builder()
    {
        return User::whereRole(Role::SuperAdministrator);
    }

    public function columns()
    {
        return [
            Column::checkbox(),

            Column::name('first_name')
                ->label('First Name')
                ->filterable()
                ->searchable(),
            Column::name('last_name')
                ->label('Last Name')
                ->filterable()
                ->searchable(),

            Column::name('email')
                ->searchable()
                ->filterable()
                ->truncate(15)
                ->view('components.tables.email-row'),

            Column::callback('status', fn (int $status) => Status::fromValue($status)->description)
                ->label('Status')
                ->filterable([['id' => Status::Active, 'name' => 'Active'], ['id' => Status::NotActive, 'name' => 'Not Active']]),

            BooleanColumn::name('email_verified_at')
                ->label('Email Verified')
                ->filterable(),

            DateColumn::name('created_at')
                ->label('Created At')
                ->format('m/d/Y')
                ->filterable(),

            ActionsColumn::actions(['id'], function ($id) {
                return view(
                    'components.tables.table-actions',
                    ['id' => $id, 'view' => 'users.view', 'update' => 'users.update', 'delete' => 'delete', 'args' => ['user_id' => $id]]
                );
            }),
        ];
    }

    public function confirmItemDeletion($id)
    {
        $this->user = User::findOrFail($id);
        $this->confirmDeletion();
    }

    public function getDeleteModel()
    {
        return $this->user;
    }

    public function resetDeleteModel()
    {
        $this->user = null;
    }
}
