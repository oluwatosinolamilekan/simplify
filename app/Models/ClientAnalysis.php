<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\Models;

use App\Enums\BusinessType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

/**
 * App\Models\ClientAnalysis.
 *
 * @property int $id
 * @property int $client_id
 * @property BusinessType $business_type
 * @property string $industry
 * @property string $region
 * @property string $loan_grade
 * @property array|null $meta
 * @property int $created_by
 * @property int $updated_by
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Client $client
 * @property User $creator
 * @property User $updater
 * @method static Builder|User   createdBy($userId)
 * @method static Builder|User   updatedBy($userId)
 * @method static Builder|Model  createdBetween(string $from, string $to)
 * @method static Builder|Model  updatedBetween(string $from, string $to)
 */
class ClientAnalysis extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'client_id',
        'business_type',
        'industry',
        'region',
        'loan_grade',
        'meta',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];

    /**
     * @var  array Default values for attributes
     */
    protected $attributes = [
        'business_type' => BusinessType::Other,
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'business_type' => 'int',
        'meta' => 'array',
    ];

    /**
     * The attributes that should be cast to enum types.
     *
     * @var array
     */
    protected $enumCasts = [
        'business_type' => BusinessType::class,
    ];

    /**
     * @return BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function getRules(bool $required = true)
    {
        return [
            'client_id' => ['required', 'int', 'exists:clients,id'],
            'industry' => [Rule::requiredIf($required), 'string', 'min:2', 'max:255'],
            'region' => [Rule::requiredIf($required), 'string', 'min:2', 'max:255'],
            'loan_grade' => [Rule::requiredIf($required), 'string', 'min:2', 'max:255'],
            'business_type' => [Rule::requiredIf($required), 'required', 'int', Rule::in(BusinessType::getValues())],
        ];
    }
}
