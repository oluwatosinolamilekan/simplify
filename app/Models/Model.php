<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\Models;

use App\Enums\Status;
use App\Models\Traits\HasMeta;
use App\Models\Traits\UsesTimestampScopes;
use BenSampo\Enum\Traits\CastsEnums;
use Closure;
use Exception;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Pagination\LengthAwarePaginator;
use RichanFongdasen\EloquentBlameable\BlameableTrait;

/**
 * Class Model.
 *
 *
 * @method static EloquentModel|Builder|null first($columns = ['*']) Execute the query and get the first result.
 * @method static EloquentModel|Builder firstOrFail($columns = ['*']) Execute the query and get the first result or throw an exception.
 * @method static Collection|Builder[] get($columns = ['*']) Execute the query as a "select" statement.
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
 * @method static Builder where($column, $operator = null, $value = null, $boolean = 'and') Add a basic where clause to the query.
 * @method Builder orWhere($column, $operator = null, $value = null) Add an "or where" clause to the query.
 * @method Builder has($relation, $operator = '>=', $count = 1, $boolean = 'and', Closure $callback = null) Add a relationship count condition to the query.
 * @method static EloquentModel|Builder find($value)
 * @method static EloquentModel|Builder findOrFail($id, $columns = ['*'])
 * @method static EloquentModel|Builder findOrNew($id, $columns = ['*'])
 * @method static Builder findMany($ids, $columns = ['*']) Find multiple models by their primary keys.
 * @method static Builder orderBy($column, $direction = 'asc')
 * @method static Builder select($columns = ['*'])
 * @method static EloquentModel|Builder create(array $attributes = [])
 * @method static EloquentModel insert(array $values)
 * @method static EloquentModel updateOrInsert(array $attributes, array $values)
 * @method static EloquentModel updateOrCreate(array $attributes, array $values)
 * @method static EloquentModel|Builder withoutGlobalScope(Scope|string $scope)
 * @method static Builder whereJsonContains($column, $value, $boolean = 'and', $not = false)
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
 * @method static Builder|Model newModelQuery()
 * @method static Builder|Model newQuery()
 * @method static Builder|Model query()
 * @method static Builder|Model updatedBetween(string $from, string $to)
 */
abstract class Model extends EloquentModel
{
    use CastsEnums;
    use UsesTimestampScopes;
    use HasFactory;
    use BlameableTrait;
    use HasMeta;

    /**
     * @var bool do not allow timestamps management. They are already being done by database.
     */
    public $timestamps = false;

    /**
     * The attributes that should be cast to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

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

    public function isDirty($attributes = [])
    {
        if (! $this->exists) {
            return ! empty(array_filter($this->getDirty(), fn ($item) => $item !== null));
        }

        return parent::isDirty($attributes);
    }

    public function ignoreDirty($attributes)
    {
        $this->syncOriginalAttribute($attributes);
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        $model = $query->getModel();
        $table = $model->getTable();
        $schema = $model->getConnection()->getSchemaBuilder();

        if ($schema->hasColumn($table, 'status')) {
            return $query->where($model->qualifyColumn('status'), Status::Active);
        }

        return $query;
    }

    public function getRules(bool $required = true)
    {
        return [];
    }

    public function getRelatedInstanceOrNew(string $relation, bool $reload = false)
    {
        if (! $this->hasRelation($relation)) {
            throw new Exception("Unknown relation {$relation} for model of class {$this}");
        }

        if ($reload) {
            $this->load($relation);
        }

        if ($this->relationLoaded($relation) && $this->{$relation}) {
            return $this->{$relation};
        }

        /** @var Relation $relation */
        $relation = $this->$relation();

        if ($relation instanceof BelongsTo) {
            $instance = $relation->newModelInstance();
        }

        if ($relation instanceof HasOne) {
            $instance = $relation->newRelatedInstanceFor($this);
        }

        $instance->syncOriginal(); // prevent making model state dirty by setting foreign key

        return $instance;
    }
}
