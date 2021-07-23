<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Vendor;

use App\Enums\Status;
use App\Enums\StatusTypesList;
use App\Models\Vendor;
use App\View\Components\Common\Datatables\ActionsColumn;
use App\View\Components\Common\Datatables\Datatable;
use App\View\Components\Traits\ConfirmModelDelete;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;

class VendorList extends Datatable
{
    use ConfirmModelDelete;

    public ?Vendor $vendor = null;

    public function render()
    {
        return view('vendors.list');
    }

    public function builder()
    {
        return Vendor::with(['factor', 'factor.company', 'client', 'client.company', 'company', 'company.identity']);
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
            Column::name('factor.company.name')
                ->label('Factor')
                ->filterable()
                ->searchable(),
            Column::name('client.company.name')
                ->label('Client')
                ->filterable()
                ->searchable(),

            Column::name('company.identity.mc_number')
                ->label('MC Number')
                ->filterable(),

            Column::name('company.identity.dot_number')
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
                    ['id' => $id, 'view' => 'vendors.view', 'update' => 'vendors.update', 'delete' => 'delete', 'args' => ['vendor_id' => $id]]
                );
            }),
        ];
    }

    public function confirmItemDeletion($id)
    {
        $this->vendor = Vendor::findOrFail($id);
        $this->confirmDeletion();
    }

    public function getDeleteModel()
    {
        return $this->vendor;
    }

    public function resetDeleteModel()
    {
        $this->vendor = null;
    }
}
