<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\Models;

use App\Enums\CreditRatingType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\DebtorCreditRatings.
 *
 * @property int $id
 * @property int $debtor_id
 * @property int $debtor_credit_id
 * @property string $rating
 * @property string $limit
 * @property string $data
 * @property CreditRatingType $type
 * @property array|null $meta
 * @property int $created_by
 * @property int $updated_by
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property DebtorCredit $debtorCredit
 * @property Debtor $debtor
 * @property User $creator
 * @property User $updater
 * @method static Builder|User   createdBy($userId)
 * @method static Builder|User   updatedBy($userId)
 * @method static Builder|Model  createdBetween(string $from, string $to)
 * @method static Builder|Model  updatedBetween(string $from, string $to)
 */
class DebtorCreditRatings extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'debtor_id',
        'debtor_credit_id',
        'rating',
        'limit',
        'data',
        'type',
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
        'meta' => 'array',
    ];

    /**
     * The attributes that should be cast to enum types.
     *
     * @var array
     */
    protected $enumCasts = [
        'type' => CreditRatingType::class,
    ];

    /**
     * @return BelongsTo
     */
    public function debtorCredit()
    {
        return $this->belongsTo(DebtorCredit::class);
    }

    /**
     * @return BelongsTo
     */
    public function debtor()
    {
        return $this->belongsTo(Debtor::class);
    }
}
