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
use App\Enums\CollectionFeeRule;
use App\Enums\EscrowRebateRule;
use App\Enums\FloatDaysType;
use App\Enums\RateBaseType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\TermFeeRules.
 *
 * @property int $id
 * @property int $term_id
 * @property float $advance_rate
 * @property float $purchase_fee_rate
 * @property float $escrow_rate
 * @property float $minimum_fee_per_invoice
 * @property bool $minimum_fee_applied_to_non_advanced_loads
 * @property CollectionFeeRule $collection_fee_rule
 * @property EscrowRebateRule $escrow_rebate_rule
 * @property BaseDateType $fee_base_date
 * @property BaseDateType $first_day_date
 * @property RateBaseType $rate_base_type
 * @property bool $prioritize_minimum_fee
 * @property FloatDaysType $float_days_type
 * @property array|null $meta
 * @property int $created_by
 * @property int $updated_by
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Term $term
 * @property FeeRule[] $feeRules
 * @property User $creator
 * @property User $updater
 * @method static Builder|User   createdBy($userId)
 * @method static Builder|User   updatedBy($userId)
 * @method static Builder|Model  createdBetween(string $from, string $to)
 * @method static Builder|Model  updatedBetween(string $from, string $to)
 */
class TermFeeRules extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'term_id',
        'advance_rate',
        'purchase_fee_rate',
        'escrow_rate',
        'minimum_fee_per_invoice',
        'minimum_fee_applied_to_non_advanced_loads',
        'collection_fee_rule',
        'escrow_rebate_rule',
        'fee_base_date',
        'first_day_date',
        'rate_base_type',
        'prioritize_minimum_fee',
        'float_days_type',
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
        'collection_fee_rule' => 'int',
        'escrow_rebate_rule' => 'int',
        'fee_base_date' => 'int',
        'first_day_date' => 'int',
        'rate_base_type' => 'int',
        'float_days_type' => 'int',
        'meta' => 'array',
    ];

    /**
     * The attributes that should be cast to enum types.
     *
     * @var array
     */
    protected $enumCasts = [
        'collection_fee_rule' => CollectionFeeRule::class,
        'escrow_rebate_rule' => EscrowRebateRule::class,
        'fee_base_date' => BaseDateType::class,
        'first_day_date' => BaseDateType::class,
        'rate_base_type' => RateBaseType::class,
        'float_days_type' => FloatDaysType::class,
    ];

    /**
     * @return BelongsTo
     */
    public function term()
    {
        return $this->belongsTo(Term::class);
    }

    /**
     * @return HasMany
     */
    public function feeRules()
    {
        return $this->hasMany(FeeRule::class, 'term_fee_rules_id');
    }
}
