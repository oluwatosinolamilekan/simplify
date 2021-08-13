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
    public $filtersPersistent = true;
    public $sortPersistent = true;
    public string $identifier;

    public function buildDatabaseQuery($export = false)
    {
        $this->storeInSession();

        parent::buildDatabaseQuery($export);
    }

    public function storeInSession()
    {
        if (! ($id = $this->getIdentifier())) {
            return;
        }

        $data = [];

        if ($this->filtersPersistent) {
            $data['filters'] = [
                'search' => $this->search,
                'activeDateFilters' => $this->activeDateFilters,
                'activeTimeFilters' => $this->activeTimeFilters,
                'activeSelectFilters' => $this->activeSelectFilters,
                'activeBooleanFilters' => $this->activeBooleanFilters,
                'activeTextFilters' => $this->activeTextFilters,
                'activeNumberFilters' => $this->activeNumberFilters,
            ];
        }

        if ($this->sortPersistent) {
            $data['sort'] = [
                'column' => $this->sort,
                'direction' => $this->direction,
            ];
        }

        session()->put("datatables.{$id}", $data);
    }

    public function restoreFromSession()
    {
        if (! ($id = $this->getIdentifier())) {
            return;
        }

        $data = session()->get("datatables.{$id}", []);

        if ($this->filtersPersistent & isset($data['filters'])) {
            foreach ($data['filters'] as $property => $value) {
                $this->{$property} = $value;
            }
        }

        if ($this->sortPersistent & isset($data['sort'])) {
            $this->sort = $data['sort']['column'];
            $this->direction = $data['sort']['direction'];
        }
    }
}
