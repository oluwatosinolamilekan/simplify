<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\User;

use App\Enums\Status;
use App\Models\User;
use App\View\Components\Common\Datatable;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;

class ListUsers extends Datatable
{
    public $hideable = 'select';
    public $exportable = true;

    public function render()
    {
        return view('user.list-users');
    }

    public function builder()
    {
        return User::query();
    }

    public function columns()
    {
        return [
            Column::checkbox(),

            Column::name('first_name')
                ->label('First Name')
                ->editable()
                ->filterable()
                ->searchable(),
            Column::name('last_name')
                ->label('Last Name')
                ->editable()
                ->filterable()
                ->searchable(),

            Column::name('email')
                ->searchable()
                ->filterable()
                ->truncate()
                ->view('components.tables.email-row'),

            Column::callback('status', fn (int $status) => Status::fromValue($status)->description)
                ->label('Status')
                ->filterable([['id' => Status::Active, 'name' => 'Active'], ['id' => Status::NotActive, 'name' => 'Not Active']]),

            BooleanColumn::name('email_verified_at')
                ->label('Email Verified')
                ->filterable(),

            DateColumn::name('created_at')
                ->label('Created At')
                ->filterable(),

            Column::callback(['id'], function ($id) {
                return view(
                    'components.tables.table-actions',
                    ['id' => $id, 'view' => 'users.view', 'update' => 'users.update', 'delete' => 'users.delete']
                );
            }),
        ];
    }
}
