<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Client;

use App\Enums\ClientType;
use App\Enums\Status;
use App\Enums\StatusTypesList;
use App\Models\Client;
use App\View\Components\Common\Datatables\Datatable;
use App\View\Components\Traits\ConfirmModelDelete;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;

class ClientList extends Datatable
{
    use ConfirmModelDelete;

    public $client = null;

    public function render()
    {
        return view('client.list');
    }

    public function builder()
    {
        return Client::with(['factor', 'factor.company', 'company', 'company.identity']);
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

            Column::name('company.identity.mc_number')
                ->label('MC Number')
                ->filterable(),
            Column::name('company.identity.dot_number')
                ->label('DOT Number')
                ->filterable(),

            Column::name('office')
                ->label('Office')
                ->filterable(),

            Column::callback('type', fn (int $type) => ClientType::fromValue($type)->description)
                ->label('Type')
                ->filterable(
                    collect(ClientType::getInstances())->map(fn ($type) => [
                        'id' => $type,
                        'name' => $type->description,
                    ])
                    ->all()
                ),

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

            Column::callback(['id'], function ($id) {
                return view(
                    'components.tables.table-actions',
                    ['id' => $id, 'view' => 'clients.view', 'update' => 'clients.update', 'delete' => 'delete']
                );
            }),
        ];
    }

    public function confirmItemDeletion($id)
    {
        $this->client = Client::findOrFail($id);
        $this->confirmDelete();
    }

    public function getDeleteModel()
    {
        return $this->client;
    }

    public function resetDeleteModel()
    {
        $this->client = null;
    }
}
