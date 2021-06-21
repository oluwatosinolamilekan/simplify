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
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Carbon;

/**
 * App\Models\BatchReceivable.
 *
 * @property int $id
 * @property int $factor_id
 * @property int $client_id
 * @property string $batch_reference
 * @property array|null $notes
 * @property array|null $meta
 * @property int $created_by
 * @property int $updated_by
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Client $client
 * @property Factor $factor
 * @property BatchDocument[] $batchDocuments
 * @property PaymentBatch[] $paymentBatches
 * @property User $creator
 * @property User $updater
 * @method static Builder|User   createdBy($userId)
 * @method static Builder|User   updatedBy($userId)
 * @method static Builder|Model  createdBetween(string $from, string $to)
 * @method static Builder|Model  updatedBetween(string $from, string $to)
 */
class BatchReceivable extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'factor_id',
        'client_id',
        'batch_reference',
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
    public function documents()
    {
        return $this->hasMany(BatchDocument::class, 'batch_id');
    }

    /**
     * @return HasManyThrough
     */
    public function payments()
    {
        return $this->hasManyThrough(Payment::class, PaymentBatch::class);
    }
}
