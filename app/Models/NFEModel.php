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
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

/**
 * App\Models\NFEModel.
 *
 * @property int $id
 * @property int $created_by
 * @property int $updated_by
 * @property string $name
 * @property float $base_rate
 * @property string $date
 * @property string $country
 * @property array|null $meta
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property User $creator
 * @property User $updater
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
        'base_rate',
        'date',
        'country',
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

    public function getRules(bool $required = true)
    {
        return [
            'name' => [Rule::requiredIf($required), 'string', 'min:2', 'max:255'],
            'base_rate' => [Rule::requiredIf($required), 'numeric', 'min:0'],
            'date' => [Rule::requiredIf($required), 'date'],
            'country' => [Rule::requiredIf($required), 'string', 'min:2', 'max:125'],
        ];
    }

    public function getValidationAttributes(string $property = '')
    {
        return [
            "{$property}.name" => 'name',
            "{$property}.base_rate" => 'base_rate',
            "{$property}.date" => 'date',
            "{$property}.country" => 'country',
        ];
    }
}
