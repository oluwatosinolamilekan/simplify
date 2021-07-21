<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Company\User;

use App\Enums\Role;
use App\Enums\RoleTypesList;
use App\Enums\Status;
use App\Enums\StatusTypesList;
use App\Models\Company;
use App\View\Components\Common\Datatables\Datatable;
use App\View\Components\Traits\ConfirmModelDelete;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;

class CompanyUsersList extends Datatable
{
    use ConfirmModelDelete;

    public Company $company;

    public function render()
    {
        return view('datatables::datatable');
    }

    public function builder()
    {
        return $this->company->users()->getQuery();
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
                ->filterable(
                    collect(RoleTypesList::Company)->map(fn ($value) => [
                        'id' => $value,
                        'name' => Role::fromValue($value)->description,
                    ])
                    ->all()
                ),

            Column::callback('user_company_access.status', fn (int $status) => Status::fromValue($status)->description)
                ->label('Status')
                ->filterable(
                    collect(StatusTypesList::UserCompanyAccess)->map(fn ($status) => [
                        'id' => $status,
                        'name' => Status::fromValue($status)->description,
                    ])
                    ->all()
                ),

            DateColumn::name('user_company_access.created_at')
                ->label('Created At')
                ->format('m/d/Y')
                ->filterable(),

            Column::callback(['id', 'user_company_access.company_id'], function ($id, $companyId) {
                return view(
                    'components.tables.table-actions',
                    [
                        'id' => $id,
                        'args' => ['user_id' => $id, 'company_id' => $companyId],
                        'view' => 'companies.users.view',
                        'update' => 'companies.users.update',
                        'delete' => 'delete',
                    ]
                );
            }),
        ];
    }
}
