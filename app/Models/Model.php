<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/simplify
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\Models;

use App\Models\Traits\UsesTimestampScopes;
use BenSampo\Enum\Traits\CastsEnums;
use Closure;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class Model.
 *
 *
 * @method static EloquentModel|EloquentBuilder|null first($columns = ['*']) Execute the query and get the first result.
 * @method static EloquentModel|EloquentBuilder firstOrFail($columns = ['*']) Execute the query and get the first result or throw an exception.
 * @method static Collection|EloquentBuilder[] get($columns = ['*']) Execute the query as a "select" statement.
 * @method mixed value($column) Get a single column's value from the first result of a query.
 * @method mixed pluck($column) Get a single column's value from the first result of a query.
 * @method void chunk($count, callable $callback) Chunk the results of the query.
 * @method \Illuminate\Support\Collection lists($column, $key = null) Get an array with the values of a given column.
 * @method LengthAwarePaginator paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null) Paginate the given query.
 * @method Paginator simplePaginate($perPage = null, $columns = ['*'], $pageName = 'page') Paginate the given query into a simple paginator.
 * @method int increment($column, $amount = 1, array $extra = []) Increment a column's value by a given amount.
 * @method int decrement($column, $amount = 1, array $extra = []) Decrement a column's value by a given amount.
 * @method void onDelete(Closure $callback) Register a replacement for the default delete function.
 * @method EloquentModel[] getModels($columns = ['*']) Get the hydrated models without eager loading.
 * @method array eagerLoadRelations(array $models) Eager load the relationships for the models.
 * @method array loadRelation(array $models, $name, Closure $constraints) Eagerly load the relationship on a set of models.
 * @method static EloquentBuilder where($column, $operator = null, $value = null, $boolean = 'and') Add a basic where clause to the query.
 * @method EloquentBuilder orWhere($column, $operator = null, $value = null) Add an "or where" clause to the query.
 * @method EloquentBuilder has($relation, $operator = '>=', $count = 1, $boolean = 'and', Closure $callback = null) Add a relationship count condition to the query.
 * @method static EloquentModel|EloquentBuilder find($value)
 * @method static EloquentModel|EloquentBuilder findOrFail($id, $columns = ['*'])
 * @method static EloquentModel|EloquentBuilder findOrNew($id, $columns = ['*'])
 * @method static EloquentBuilder findMany($ids, $columns = ['*']) Find multiple models by their primary keys.
 * @method static EloquentBuilder orderBy($column, $direction = 'asc')
 * @method static EloquentBuilder select($columns = ['*'])
 * @method static EloquentModel|EloquentBuilder create(array $attributes = [])
 * @method static EloquentModel insert(array $values)
 * @method static EloquentModel updateOrInsert(array $attributes, array $values)
 * @method static EloquentModel updateOrCreate(array $attributes, array $values)
 * @method static EloquentModel|EloquentBuilder withoutGlobalScope(Scope|string $scope)
 * @method static EloquentBuilder whereJsonContains($column, $value, $boolean = 'and', $not = false)
 *
 * @method static QueryBuilder whereRaw($sql, array $bindings = [])
 * @method static QueryBuilder whereBetween($column, array $values)
 * @method static QueryBuilder whereNotBetween($column, array $values)
 * @method static QueryBuilder whereNested(Closure $callback)
 * @method static QueryBuilder addNestedWhereQuery($query)
 * @method static QueryBuilder whereExists(Closure $callback)
 * @method static QueryBuilder whereNotExists(Closure $callback)
 * @method static QueryBuilder whereIn($column, $values)
 * @method static QueryBuilder whereNotIn($column, $values)
 * @method static QueryBuilder whereNull($column)
 * @method static QueryBuilder whereNotNull($column)
 * @method static QueryBuilder orWhereRaw($sql, array $bindings = [])
 * @method static QueryBuilder orWhereBetween($column, array $values)
 * @method static QueryBuilder orWhereNotBetween($column, array $values)
 * @method static QueryBuilder orWhereExists(Closure $callback)
 * @method static QueryBuilder orWhereNotExists(Closure $callback)
 * @method static QueryBuilder orWhereIn($column, $values)
 * @method static QueryBuilder orWhereNotIn($column, $values)
 * @method static QueryBuilder orWhereNull($column)
 * @method static QueryBuilder orWhereNotNull($column)
 * @method static QueryBuilder whereDate($column, $operator, $value)
 * @method static QueryBuilder whereDay($column, $operator, $value)
 * @method static QueryBuilder whereMonth($column, $operator, $value)
 * @method static QueryBuilder whereYear($column, $operator, $value)
 * @method static QueryBuilder join($table, $first, $operator = null, $second = null, $type = 'inner', $where = false)
 * @method static QueryBuilder latest($column = 'created_at')
 * @method static Builder|Model createdBetween(string $from, string $to)
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|Model updatedBetween(string $from, string $to)
 *
 * @method mixed getMeta(string $key, $default = null)
 * @method mixed updateMeta(string $key, $value, bool $save = true)
 */
abstract class Model extends EloquentModel
{
    use CastsEnums;
    use UsesTimestampScopes;

    /**
     * @var bool do not allow timestamps management. They are already being done by database.
     */
    public $timestamps = false;

    /**
     * Determine if the given relationship (method) exists.
     *
     * @param  string  $key
     * @return bool
     */
    public function hasRelation($key): bool
    {
        // If the key already exists in the relationships array, it just means the
        // relationship has already been loaded, so we'll just return it out of
        // here because there is no need to query within the relations twice.
        if ($this->relationLoaded($key)) {
            return true;
        }

        // If the "attribute" exists as a method on the model, we will just assume
        // it is a relationship and will load and return results from the query
        // and hydrate the relationship's value on the "relationships" array.
        if (method_exists($this, $key)) {
            //Uses PHP built in function to determine whether the returned object is a laravel relation
            return $this->$key() instanceof Relation;
        }

        return false;
    }
}
