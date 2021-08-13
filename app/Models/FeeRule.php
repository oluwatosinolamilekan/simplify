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

    protected static $ruleConfig = [
        FeeRuleType::CollectionFee => [
            'start_day' => 1,
            'thru_day' => 30,
        ],
        FeeRuleType::IntervalFee => [
            'start_day' => 1,
            'interval' => 7,
            'max_rate' => 100,
            'calculate_age_based_on' => BaseDateType::InvoiceDate,
        ],
        FeeRuleType::FlatFee => [
            'rate_type' => RateType::Percent,
        ],
        FeeRuleType::NegativeReserveFee => [
            'rate_type' => RateType::Percent,
        ],
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

        $attributes = array_merge([
            'type' => $type,
            'label' => FeeRuleType::fromValue($type)->description,
            'configuration' => self::$ruleConfig[$type] ?? [],
        ], $attributes);

        return new self($attributes);
    }

    public function getRules(bool $required = true)
    {
        return [
            'label' => ['string', 'min:2', 'max:255'],
            'type' => ['required', 'int', Rule::in(FeeRuleType::getValues())],
            'rate' => ['required', 'numeric', 'min:0'],
            'configuration' => ['array'],
        ];
    }

    public function getConfigurationRules()
    {
        return [
            'rate_type' => ['required_if:type,3,4', 'int', Rule::in(RateType::getValues())],
            'start_day' => ['required_if:type,1,2', 'int', 'min:1', 'max:90'],
            'thru_day' => ['required_if:type,1', 'int', 'min:1', 'max:90'],
            'calculate_age_based_on' => ['required_if:type,2', 'int', Rule::in(BaseDateType::getValues())],
            'interval' => ['required_if:type,2', 'int', 'min:1', 'max:90'],
            'max_rate' => ['required_if:type,2', 'numeric', 'min:0', 'max:100'],
            'float_days' => ['required_if:type,5', 'int', 'min:1', 'max:90'],
            'nfe_model_id' => ['required_if:type,5', 'int', 'exists:nfe_models,id'],
        ];
    }

    public function getValidationAttributes(string $property = '')
    {
        return [
            "{$property}.rate" => 'rate',
            "{$property}.configuration.start_day" => 'start day',
            "{$property}.configuration.thru_day" => 'thru day',
            "{$property}.configuration.interval" => 'interval',
            "{$property}.configuration.calculate_age_based_on" => 'calculate age based on',
            "{$property}.configuration.rate_type" => 'rate type',
            "{$property}.configuration.max_rate" => 'max rate',
            "{$property}.configuration.float_days" => 'float days',
            "{$property}.configuration.nfe_model_id" => 'nfe model',
        ];
    }
}
