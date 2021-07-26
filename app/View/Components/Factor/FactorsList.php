<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Factor;

use App\Enums\Status;
use App\Enums\StatusTypesList;
use App\Models\Factor;
use App\Models\SubscriptionPlan;
use App\View\Components\Common\Datatables\ActionsColumn;
use App\View\Components\Common\Datatables\Datatable;
use App\View\Components\Traits\ConfirmModelDelete;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;

class FactorsList extends Datatable
{
    use ConfirmModelDelete;

    public $factor = null;

    public function render()
    {
        return view('factors.list');
    }

    public function builder()
    {
        return Factor::with('company');
    }

    public function columns()
    {
        return [
            Column::name('ref_code')
                ->searchable()
                ->filterable()
                ->truncate(15)
                ->view('components.tables.email-row'),

            Column::name('company.name')
                ->label('Name')
                ->filterable()
                ->searchable(),

            Column::name('company.domain')
                ->label('Domain')
                ->filterable()
                ->searchable(),

            Column::callback('status', fn (int $status) => Status::fromValue($status)->description)
                ->label('Status')
                ->filterable(
                    collect(StatusTypesList::Factor)->map(fn ($status) => [
                        'id' => $status,
                        'name' => Status::fromValue($status)->description,
                    ])
                    ->all()
                ),
            Column::name('subscriptionPlan.name')
                ->label('Subscription Plan')
                ->filterable(SubscriptionPlan::pluck('name')->all()),

            DateColumn::name('created_at')
                ->label('Created At')
                ->format('m/d/Y')
                ->filterable(),

            ActionsColumn::actions(['id'], function ($id) {
                return view(
                    'components.tables.table-actions',
                    ['id' => $id, 'view' => 'factors.view', 'update' => 'factors.update', 'delete' => 'delete', 'args' => ['factor_id' => $id]]
                );
            }),
        ];
    }

    public function confirmItemDeletion($id)
    {
        $this->factor = Factor::with('company')->findOrFail($id);
        $this->confirmDeletion();
    }

    public function getDeleteModel()
    {
        return $this->factor;
    }

    public function resetDeleteModel()
    {
        $this->factor = null;
    }
}
