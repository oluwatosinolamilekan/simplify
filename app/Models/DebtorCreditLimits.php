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

/**
 * App\Models\DebtorCreditLimits.
 *
 * @property int $id
 * @property int $debtor_id
 * @property float $all_customer_limit
 * @property Carbon $credit_date
 * @property Carbon $credit_expiry_date
 * @property int $months_good_for
 * @property array|null $notes
 * @property array|null $meta
 * @property int $created_by
 * @property int $updated_by
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Debtor $debtor
 * @method static Builder|User   createdBy($userId)
 * @method static Builder|User   updatedBy($userId)
 * @method static Builder|Model  createdBetween(string $from, string $to)
 * @method static Builder|Model  updatedBetween(string $from, string $to)
 */
class DebtorCreditLimits extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'debtor_id',
        'all_customer_limit',
        'credit_date',
        'credit_expiry_date',
        'months_good_for',
        'notes',
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
        'notes' => 'array',
        'meta' => 'array',
    ];

    /**
     * The attributes that should be cast to dates.
     *
     * @var array
     */
    protected $dates = [
        'credit_date',
        'credit_expiry_date',
        'created_at',
        'updated_at',
    ];

    /**
     * @return BelongsTo
     */
    public function debtor()
    {
        return $this->belongsTo(Debtor::class);
    }
}
