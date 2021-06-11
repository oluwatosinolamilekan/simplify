<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Traits;

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
        if (! $this->filtersPersistent) {
            return;
        }

        session()->put("filters.{$this->route}", [
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
        if (! $this->filtersPersistent) {
            return;
        }

        foreach (session()->get("filters.{$this->route}", []) as $property => $value) {
            $this->{$property} = $value;
        }
    }
}
