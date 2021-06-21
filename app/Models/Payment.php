<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\Models;

use App\Enums\PaymentMethod;
use App\Enums\Status;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Payment.
 *
 * @property int $id
 * @property int $factor_id
 * @property int $client_id
 * @property Carbon $date
 * @property Status $status
 * @property float $amount
 * @property PaymentMethod $method
 * @property float $fee
 * @property string $transaction_reference
 * @property string $remitter
 * @property string $memo
 * @property array|null $notes
 * @property array|null $meta
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Client $client
 * @property Factor $factor
 * @property PaymentBatch[] $paymentBatches
 * @property PaymentDocument[] $paymentDocuments
 * @property PaymentInvoice[] $paymentInvoices
 * @property User $creator
 * @property User $updater
 * @method static Builder|User   createdBy($userId)
 * @method static Builder|User   updatedBy($userId)
 * @method static Builder|Model  createdBetween(string $from, string $to)
 * @method static Builder|Model  updatedBetween(string $from, string $to)
 */
class Payment extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'factor_id',
        'client_id',
        'date',
        'status',
        'amount',
        'method',
        'fee',
        'transaction_reference',
        'remitter',
        'memo',
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
        'payment_method' => 'int',
        'status' => 'int',
        'meta' => 'array',
    ];

    /**
     * The attributes that should be cast to enum types.
     *
     * @var array
     */
    protected $enumCasts = [
        'payment_method' => PaymentMethod::class,
        'status' => Status::class,
    ];

    /**
     * The attributes that should be cast to dates.
     *
     * @var array
     */
    protected $dates = [
        'date',
        'created_at',
        'updated_at',
    ];

    /**
     * @return BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * @return BelongsTo
     */
    public function factor()
    {
        return $this->belongsTo(Factor::class);
    }

    /**
     * @return HasMany
     */
    public function paymentBatches()
    {
        return $this->hasMany(PaymentBatch::class);
    }

    /**
     * @return HasMany
     */
    public function paymentDocuments()
    {
        return $this->hasMany(PaymentDocument::class);
    }

    /**
     * @return HasMany
     */
    public function paymentInvoices()
    {
        return $this->hasMany(PaymentInvoice::class);
    }
}
