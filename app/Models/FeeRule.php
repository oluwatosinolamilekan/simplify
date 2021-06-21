<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\Models;

use App\Enums\FeeRuleType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\FeeRule.
 *
 * @property int $id
 * @property int $term_fee_rules_id
 * @property string $label
 * @property FeeRuleType $type
 * @property float $rate
 * @property array|null $configuration
 * @property array|null $meta
 * @property int $created_by
 * @property int $updated_by
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property TermFeeRules $termFeeRule
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
        'term_fee_rules_id',
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

    /**
     * @return BelongsTo
     */
    public function termFeeRule()
    {
        return $this->belongsTo(TermFeeRules::class, 'term_fee_rules_id');
    }
}
