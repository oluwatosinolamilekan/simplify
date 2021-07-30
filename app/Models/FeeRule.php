<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\Models;

use App\Enums\BaseDateType;
use App\Enums\FeeRuleType;
use App\Enums\RateType;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

/**
 * App\Models\FeeRule.
 *
 * @property int $id
 * @property int $term_id
 * @property string $label
 * @property FeeRuleType $type
 * @property float $rate
 * @property array|null $configuration
 * @property Model $config
 * @property array|null $meta
 * @property int $created_by
 * @property int $updated_by
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Term $term
 * @property User $creator
 * @property User $updater
 * @method static Builder|User   createdBy($userId)
 * @method static Builder|User   updatedBy($userId)
 * @method static Builder|Model  createdBetween(string $from, string $to)
 * @method static Builder|Model  updatedBetween(string $from, string $to)
 */
class FeeRule extends Model
{
    protected $table = 'fee_rules';
    /**
     * @var array
     */
    protected $fillable = [
        'term_id',
        'label',
        'type',
        'rate',
        'configuration',
        'meta',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'type' => 'int',
        'configuration' => 'array',
        'meta' => 'array',
    ];

    /**
     * The attributes that should be cast to enum types.
     *
     * @var array
     */
    protected $enumCasts = [
        'type' => FeeRuleType::class,
    ];

    protected $attributes = [
        'configuration' => '[]',
    ];

    /**
     * @return BelongsTo
     */
    public function term()
    {
        return $this->belongsTo(Term::class, 'term_id');
    }

    public static function fromType(int $type, array $attributes = [])
    {
        if (! FeeRuleType::hasValue($type)) {
            throw new Exception("Invalid fee rule type {$type}");
        }

        return new self($attributes + ['type' => $type, 'configuration' => []]);
    }

    public function getRules(bool $required = true)
    {
        return [
            'label' => ['string', 'min:2', 'max:255'],
            'type' => ['required', 'int', Rule::in(FeeRuleType::getValues())],
            'rate' => ['required', 'numeric', 'gt:0'],
            'configuration' => ['array'],
            'configuration.rate_type' => ['required_if:type,3,4', 'int', Rule::in(RateType::getValues())],
            'configuration.start_day' => ['required_if:type,1,2', 'int'],
            'configuration.thru_day' => ['required_if:type,1', 'int'],
            'configuration.calculate_age_based_on' => ['required_if:type,2', 'int', Rule::in(BaseDateType::getValues())],
            'configuration.interval' => ['required_if:type,2', 'int'],
            'configuration.max_rate' => ['required_if:type,2', 'numeric', 'min:0', 'max:100'],
        ];
    }
}
