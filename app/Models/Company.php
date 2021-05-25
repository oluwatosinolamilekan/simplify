<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/simplify
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\Models;

use App\Enums\Status;
use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use RichanFongdasen\EloquentBlameable\BlameableTrait;

/**
 * App\Models\Company.
 *
 * @property int $id
 * @property string $name
 * @property string $domain
 * @property Status $status
 * @property array|null $meta
 * @property int $created_by
 * @property int $updated_by
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property User $creator
 * @property User $updater
 * @method static Company active()
 * @method static Builder|Company createdBy($userId)
 * @method static Builder|Company updatedBy($userId)
 * @method static Builder|Model createdBetween(string $from, string $to)
 * @method static Builder|Model updatedBetween(string $from, string $to)
 * @mixin Eloquent
 * @method static Builder|Company newModelQuery()
 * @method static Builder|Company newQuery()
 * @method static Builder|Company query()
 */
class Company extends Model
{
    use HasFactory;
    use BlameableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'domain',
        'status',
        'meta',
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'int',
        'meta' => 'array',
    ];

    /**
     * The attributes that should be cast to enum types.
     *
     * @var array
     */
    protected $enumCasts = [
        'status' => Status::class,
    ];

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
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', Status::Active);
    }
}
