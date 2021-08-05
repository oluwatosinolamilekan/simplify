<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Term;

use App\Enums\Status;
use App\Enums\StatusTypesList;
use App\Enums\TermType;
use App\Models\Term;
use App\View\Components\Common\Datatables\ActionsColumn;
use App\View\Components\Common\Datatables\Datatable;
use App\View\Components\Common\Datatables\RelationColumn;
use App\View\Components\Traits\ConfirmModelDelete;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;

class TermsList extends Datatable
{
    use ConfirmModelDelete;

    public ?Term $term = null;

    public function render()
    {
        return view('terms.list');
    }

    public function builder()
    {
        return Term::with([
            'factor',
            'factor.company',
            'clients',
            'feeRules',
        ]);
    }

    public function columns()
    {
        return [
            Column::name('code')
                ->label('Code')
                ->searchable()
                ->filterable(),

            Column::name('name')
                ->label('Name')
                ->filterable()
                ->searchable(),

            Column::callback('type', fn (int $type) => TermType::fromValue($type)->description)
                ->label('Type')
                ->filterable(
                    collect(TermType::getInstances())->map(fn ($type) => [
                        'id' => $type->key,
                        'name' => $type->description,
                    ])
                    ->all()
                ),

            RelationColumn::name('factor.company.name')
                ->alias('factor_company')
                ->label('Factor')
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
            DateColumn::name('created_at')
                ->label('Created At')
                ->format('m/d/Y')
                ->filterable(),

            ActionsColumn::actions(['id'], function ($id) {
                return view(
                    'components.tables.table-actions',
                    ['id' => $id, 'view' => 'terms.view', 'update' => 'terms.update', 'delete' => 'delete', 'args' => ['term_id' => $id]]
                );
            }),
        ];
    }

    public function confirmItemDeletion($id)
    {
        $this->term = Term::findOrFail($id);
        $this->confirmDeletion();
    }

    public function getDeleteModel()
    {
        return $this->term;
    }

    public function resetDeleteModel()
    {
        $this->term = null;
    }
}
