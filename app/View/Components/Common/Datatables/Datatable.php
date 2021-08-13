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
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class Datatable extends LivewireDatatable
{
    use WithPersistentFilters;

    public $hideable = 'select';
    public $exportable = true;

    public function mount(
        $model = null,
        $include = [],
        $exclude = [],
        $hide = [],
        $dates = [],
        $times = [],
        $searchable = [],
        $sort = null,
        $hideHeader = null,
        $hidePagination = null,
        $perPage = null,
        $exportable = false,
        $hideable = false,
        $beforeTableSlot = false,
        $afterTableSlot = false,
        $params = []
    ) {
        foreach (['model', 'include', 'exclude', 'hide', 'dates', 'times', 'searchable', 'sort', 'hideHeader', 'hidePagination', 'exportable', 'hideable', 'beforeTableSlot', 'afterTableSlot'] as $property) {
            $this->$property = $this->$property ?? $$property;
        }

        $this->params = $params;

        $this->columns = $this->getViewColumns();

        $this->initialiseSort();

        $this->restoreFromSession();

        $this->perPage = $perPage ?? $this->perPage ?? config('livewire-datatables.default_per_page', 10);
    }

    public function getIdentifier()
    {
        if (isset($this->identifier)) {
            return $this->identifier;
        }

        return Str::snake(Str::afterLast(get_called_class(), '\\'));
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

    public function doDateFilterRange($index, $range)
    {
        [$start, $end] = empty($range) ? [null, null] : explode(' - ', $range);

        parent::doDateFilterStart($index, $start);
        parent::doDateFilterEnd($index, $end);
        $this->clearEmptyDateFilter($index);
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
        );
    }

    /** Override Livewire defaultSort method since it's not working properly */
    public function defaultSort()
    {
        $columnIndex = collect($this->freshColumns)->search(function ($column) {
            return isset($column['defaultSort']);
        });

        return is_numeric($columnIndex) ? [
            'key' => $columnIndex,
            'direction' => $this->freshColumns[$columnIndex]['defaultSort'],
        ] : null;
    }

    /** Override Livewire datatable methods to enable multiple relational columns that are using the same table */
    public function resolveColumnName($column)
    {
        if ($column instanceof RelationColumn) {
            return $this->resolveRelationColumn($column->base ?? $column->name, $column->aggregate, $column->alias);
        }

        return parent::resolveColumnName($column);
    }

    protected function resolveRelationColumn($name, $aggregate = null, $alias = null)
    {
        $parts = explode('.', Str::before($name, ':'));
        $columnName = array_pop($parts);
        $relation = implode('.', $parts);

        return  method_exists($this->query->getModel(), $parts[0])
            ? $this->joinRelation($relation, $columnName, $aggregate, $alias)
            : $name;
    }

    protected function joinRelation($relation, $relationColumn, $aggregate = null, $alias = null)
    {
        $lastQuery = $this->query;
        $relations = explode('.', $relation);

        foreach ($relations as $eachRelation) {
            $model = $lastQuery->getRelation($eachRelation);
            $table = $model->getRelated()->getTable();

            switch (true) {
                case $model instanceof HasOne:

                    $foreign = $model->getQualifiedForeignKeyName();
                    $other = $model->getQualifiedParentKeyName();
                    break;

                case $model instanceof BelongsToMany:
                case $model instanceof HasMany:
                    $this->query->customWithAggregate($relation, $aggregate ?? 'count', $relationColumn, $alias);
                    $table = null;
                    break;

                case $model instanceof BelongsTo:
                    $foreign = $model->getQualifiedForeignKeyName();
                    $other = $model->getQualifiedOwnerKeyName();
                    break;

                case $model instanceof HasOneThrough:
                    $pivot = explode('.', $model->getQualifiedParentKeyName())[0];
                    $pivotPK = $model->getQualifiedFirstKeyName();
                    $pivotFK = $model->getQualifiedLocalKeyName();
                    $this->performJoin($pivot, $pivotPK, $pivotFK);

                    $related = $model->getRelated();
                    $tablePK = $related->getForeignKey();
                    $foreign = $pivot.'.'.$tablePK;
                    $other = $related->getQualifiedKeyName();

                    break;

                default:
                    $this->query->customWithAggregate($relation, $aggregate ?? 'count', $relationColumn, $alias);
            }

            if ($table) {
                if ($alias && $eachRelation === last($relations)) {
                    $this->performJoin($table.' as '.$alias, $foreign, str_replace($table, $alias, $other));
                } else {
                    $this->performJoin($table, $foreign, $other);
                }
            }
            $lastQuery = $model->getQuery();
        }

        if ($model instanceof HasOne || $model instanceof BelongsTo || $model instanceof HasOneThrough) {
            return ($alias ?? $table).'.'.$relationColumn;
        }

        return $relationColumn;
    }
}
