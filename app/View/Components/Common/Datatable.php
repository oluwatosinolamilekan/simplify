<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Common;

use App\View\Components\Traits\WithPersistentFilters;
use Illuminate\Contracts\Container\Container;
use Illuminate\Routing\Route;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class Datatable extends LivewireDatatable
{
    use WithPersistentFilters;

    public $filtersPersistent = true;
    public $route = null;

    public function __invoke(Container $container, Route $route)
    {
        $this->route = $route->getName();

        return parent::__invoke($container, $route);
    }

    public function clearAllFilters()
    {
        parent::clearAllFilters();
        $this->reset('search', 'activeDateFilters', 'activeTimeFilters');
        $this->storeFiltersInSession();
    }

    public function applyFilter($filter, ...$arguments)
    {
        if (
            method_exists($this, $method = 'do'.ucfirst($filter).'Filter') ||
            method_exists($this, $method = 'do'.ucfirst($filter))
        ) {
            $this->$method(...$arguments);
            $this->storeFiltersInSession();
        }
    }

    public function removeFilter($filter, ...$arguments)
    {
        if (
            method_exists($this, $method = 'remove'.ucfirst($filter).'Filter') ||
            method_exists($this, $method = 'remove'.ucfirst($filter))
        ) {
            $this->$method(...$arguments);
            $this->storeFiltersInSession();
        }
    }
}
