<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Common\Datatables;

use App\View\Components\Traits\WithPersistentFilters;
use Illuminate\Contracts\Container\Container;
use Illuminate\Routing\Route;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class Datatable extends LivewireDatatable
{
    use WithPersistentFilters;

    public $hideable = 'select';
    public $exportable = true;
    public $filtersPersistent = true;
    public $route = null;

    public $textFilters = [];
    public $booleanFilters = [];
    public $selectFilters = [];

    public function __invoke(Container $container, Route $route)
    {
        $this->route = $route->getName();

        return parent::__invoke($container, $route);
    }

    public function applyFilter($filter, ...$arguments)
    {
        if (
            method_exists($this, $method = 'do'.ucfirst($filter).'Filter') ||
            method_exists($this, $method = 'do'.ucfirst($filter))
        ) {
            $this->$method(...$arguments);
        }
    }

    public function removeFilter($filter, ...$arguments)
    {
        if (
            method_exists($this, $method = 'remove'.ucfirst($filter).'Filter') ||
            method_exists($this, $method = 'remove'.ucfirst($filter))
        ) {
            $this->$method(...$arguments);
        }
    }

    public function doDateFilterStart($index, $start)
    {
        parent::doDateFilterStart($index, $start);
        $this->clearEmptyDateFilter($index);
    }

    public function doDateFilterEnd($index, $start)
    {
        parent::doDateFilterEnd($index, $start);
        $this->clearEmptyDateFilter($index);
    }

    public function clearEmptyDateFilter($index)
    {
        if (empty(array_filter($this->activeDateFilters[$index]))) {
            unset($this->activeDateFilters[$index]);
        }
    }

    public function removeDateFilter($index)
    {
        unset($this->activeDateFilters[$index]);
    }

    public function clearAllFilters()
    {
        parent::clearAllFilters();
        $this->reset(
            'activeDateFilters',
            'activeTimeFilters',
            'textFilters',
            'selectFilters',
        );
    }

    public function applyAllFilters()
    {
        foreach ($this->textFilters as $index => $filter) {
            $this->applyFilter('text', $index, $filter);
        }

        foreach ($this->selectFilters as $index => $filter) {
            $this->applyFilter('select', $index, $filter);
        }

        foreach ($this->booleanFilters as $index => $filter) {
            $this->applyFilter('boolean', $index, $filter);
        }

        $this->textFilters = [];
        $this->selectFilters = [];
        $this->booleanFilters = [];
    }
}
