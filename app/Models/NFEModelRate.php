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
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

/**
 * App\Models\NFEModelRate.
 *
 * @property int $id
 * @property int $nfe_model_id
 * @property float $base_rate
 * @property string $date
 * @property string $country
 * @property array|null $meta
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property User $creator
 * @property User $updater
 * @property NFEModel $nfeModel
 * @method static Builder|User   createdBy($userId)
 * @method static Builder|User   updatedBy($userId)
 * @method static Builder|Model  createdBetween(string $from, string $to)
 * @method static Builder|Model  updatedBetween(string $from, string $to)
 */
class NFEModelRate extends Model
{
    protected $table = 'nfe_model_rates';

    /**
     * @var array
     */
    protected $fillable = [
        'nfe_model_id',
        'base_rate',
        'date',
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
        'date:Y-m-d',
        'created_at',
        'updated_at',
    ];

    /**
     * @return BelongsTo
     */
    public function nfeModel()
    {
        return $this->belongsTo(NFEModel::class, 'nfe_model_id');
    }

    public function getRules(bool $required = true)
    {
        return [
            'nfe_model_id' => ['int'],
            'base_rate' => [Rule::requiredIf($required), 'numeric', 'min:0'],
            'date' => [Rule::requiredIf($required), 'date'],
        ];
    }

    public function getValidationAttributes(string $property = '')
    {
        return [
            "{$property}.base_rate" => 'base rate',
            "{$property}.date" => 'date',
        ];
    }
}
