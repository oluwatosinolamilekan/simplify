<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Factor;

use App\Enums\Role;
use App\Enums\RoleTypesList;
use App\Enums\Status;
use App\Models\Factor;
use App\View\Components\User\UsersList;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;

class FactorUsersList extends UsersList
{
    public Factor $factor;

    public function builder()
    {
        return $this->factor->company->users()->getQuery();
    }

    public function columns()
    {
        return [
            Column::name('user_company_access.first_name')
                ->label('First Name')
                ->filterable()
                ->searchable(),
            Column::name('user_company_access.last_name')
                ->label('Last Name')
                ->filterable()
                ->searchable(),

            Column::name('email')
                ->searchable()
                ->filterable()
                ->truncate(15)
                ->view('components.tables.email-row'),

            Column::callback('user_company_access.role', fn (int $status) => Role::fromValue($status)->description)
                ->label('Status')
                ->filterable(collect(RoleTypesList::Company)->map(fn ($value) => ['id' => $value, 'name' => Role::fromValue($value)->description])->all()),

            Column::callback('user_company_access.status', fn (int $status) => Status::fromValue($status)->description)
                ->label('Status')
                ->filterable([['id' => Status::Active, 'name' => 'Active'], ['id' => Status::NotActive, 'name' => 'Not Active']]),

            DateColumn::name('user_company_access.created_at')
                ->label('Created At')
                ->format('m/d/Y')
                ->filterable(),

            Column::callback(['id'], function ($id) {
                return view(
                    'components.tables.table-actions',
                    ['id' => $id, 'view' => 'users.view', 'update' => 'users.update', 'delete' => 'delete']
                );
            }),
        ];
    }
}
