<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

/**
 * App\Models\NFEModel.
 *
 * @property int $id
 * @property string $name
 * @property array|null $meta
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property User $creator
 * @property User $updater
 * @property NFEModelRate[] $rates
 * @method static Builder|User   createdBy($userId)
 * @method static Builder|User   updatedBy($userId)
 * @method static Builder|Model  createdBetween(string $from, string $to)
 * @method static Builder|Model  updatedBetween(string $from, string $to)
 */
class NFEModel extends Model
{
    protected $table = 'nfe_models';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
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
        'meta' => 'array',
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

    public static function boot()
    {
        parent::boot();

        static::deleting(fn ($model) => $model->rates()->delete());
    }

    /**
     * @return HasMany
     */
    public function rates()
    {
        return $this->hasMany(NFEModelRate::class, 'nfe_model_id', 'id');
    }

    public function feeRules()
    {
        return $this->hasMany(FeeRule::class, 'configuration->nfe_model_id', 'id');
    }

    public function getRules(bool $required = true)
    {
        return [
            'name' => [Rule::requiredIf($required), 'string', 'min:2', 'max:255'],
        ];
    }

    public function getValidationAttributes(string $property = '')
    {
        return [
            "{$property}.name" => 'name',
        ];
    }
}
