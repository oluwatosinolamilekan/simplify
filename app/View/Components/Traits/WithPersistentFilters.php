<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Traits;

use Illuminate\Support\Str;
use Log;

trait WithPersistentFilters
{
    public function initializeWithPersistentFilters()
    {
        $this->restoreFiltersFromSession();
    }

    public function buildDatabaseQuery($export = false)
    {
        $this->storeFiltersInSession();

        parent::buildDatabaseQuery($export);
    }

    public function storeFiltersInSession()
    {
        $name = $this->name ?? Str::snake(Str::afterLast(get_called_class(), '\\'));

        Log::debug("filters.{$this->route}.{$name}");

        if (! $this->filtersPersistent || ! $this->route || ! $name) {
            return;
        }

        session()->put("filters.{$this->route}.{$name}", [
            'search' => $this->search,
            'activeDateFilters' => $this->activeDateFilters,
            'activeTimeFilters' => $this->activeTimeFilters,
            'activeSelectFilters' => $this->activeSelectFilters,
            'activeBooleanFilters' => $this->activeBooleanFilters,
            'activeTextFilters' => $this->activeTextFilters,
            'activeNumberFilters' => $this->activeNumberFilters,
        ]);
    }

    public function restoreFiltersFromSession()
    {
        $name = $this->name ?? Str::snake(Str::afterLast(get_called_class(), '\\'));

        if (! $this->filtersPersistent || ! $this->route || ! $name) {
            return;
        }

        foreach (session()->get("filters.{$this->route}.{$name}", []) as $property => $value) {
            $this->{$property} = $value;
        }
    }
}
