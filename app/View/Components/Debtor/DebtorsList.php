<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Debtor;

use App\Enums\Status;
use App\Enums\StatusTypesList;
use App\Models\Debtor;
use App\View\Components\Common\Datatables\ActionsColumn;
use App\View\Components\Common\Datatables\Datatable;
use App\View\Components\Common\Datatables\RelationColumn;
use App\View\Components\Traits\ConfirmModelDelete;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;

class DebtorsList extends Datatable
{
    use ConfirmModelDelete;

    public ?Debtor $debtor = null;

    public function render()
    {
        return view('debtors.list');
    }

    public function builder()
    {
        return Debtor::with([
            'factor',
            'factor.company',
            'client',
            'client.company',
            'company',
            'company.identity',
        ]);
    }

    public function columns()
    {
        return [
            Column::name('ref_code')
                ->searchable()
                ->filterable()
                ->truncate(15)
                ->view('components.tables.email-row'),

            RelationColumn::name('factor.company.name')
                ->alias('factor_company')
                ->label('Factor')
                ->filterable()
                ->searchable(),
            RelationColumn::name('client.company.name')
                ->alias('client_company')
                ->label('Client')
                ->filterable()
                ->searchable(),

            RelationColumn::name('company.identity.mc_number')
                ->label('MC Number')
                ->filterable(),

            RelationColumn::name('company.identity.dot_number')
                ->label('DOT Number')
                ->filterable(),

            Column::callback('status', fn (int $status) => Status::fromValue($status)->description)
                ->label('Status')
                ->filterable(
                    collect(StatusTypesList::Factor)->map(fn ($status) => [
                        'id' => $status,
                        'name' => Status::fromValue($status)->description,
                    ])
                        ->all()
                ),
            DateColumn::name('created_at')
                ->label('Created At')
                ->format('m/d/Y')
                ->filterable(),

            ActionsColumn::actions(['id'], function ($id) {
                return view(
                    'components.tables.table-actions',
                    ['id' => $id, 'view' => 'debtors.view', 'update' => 'debtors.update', 'delete' => 'delete', 'args' => ['debtor_id' => $id]]
                );
            }),
        ];
    }

    public function confirmItemDeletion($id)
    {
        $this->debtor = Debtor::findOrFail($id);
        $this->confirmDeletion();
    }

    public function getDeleteModel()
    {
        return $this->debtor;
    }

    public function resetDeleteModel()
    {
        $this->debtor = null;
    }
}
