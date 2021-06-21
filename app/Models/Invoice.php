<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Invoice.
 *
 * @property int $id
 * @property int $factor_id
 * @property int $client_id
 * @property int $debtor_id
 * @property int $vendor_id
 * @property string $invoice_number
 * @property string $reference_number
 * @property Carbon $date
 * @property Carbon $due_date
 * @property float $amount
 * @property float $advance_rate
 * @property float $advance_amount
 * @property Carbon $purchase_date
 * @property Carbon $payment_date
 * @property Status $status
 * @property array|null $notes
 * @property array|null $meta
 * @property int $created_by
 * @property int $updated_by
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Client $client
 * @property Debtor $debtor
 * @property Factor $factor
 * @property Vendor $vendor
 * @property InvoiceDocument[] $invoiceDocuments
 * @property PaymentInvoice[] $paymentInvoices
 * @property ScheduleInvoice[] $scheduleInvoices
 * @property User $creator
 * @property User $updater
 * @method static Builder|User   createdBy($userId)
 * @method static Builder|User   updatedBy($userId)
 * @method static Builder|Model  createdBetween(string $from, string $to)
 * @method static Builder|Model  updatedBetween(string $from, string $to)
 */
class Invoice extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'factor_id',
        'client_id',
        'debtor_id',
        'vendor_id',
        'invoice_number',
        'reference_number',
        'date',
        'due_date',
        'amount',
        'advance_rate',
        'advance_amount',
        'purchase_date',
        'payment_date',
        'status',
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
        'status' => 'int',
        'notes' => 'array',
        'meta' => 'array',
    ];

    /**
     * The attributes that should be cast to enum types.
     *
     * @var array
     */
    protected $enumCasts = [
        'status' => Status::class,
    ];

    /**
     * The attributes that should be cast to dates.
     *
     * @var array
     */
    protected $dates = [
        'date',
        'due_date',
        'purchase_date',
        'payment_date',
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
    public function debtor()
    {
        return $this->belongsTo(Debtor::class);
    }

    /**
     * @return BelongsTo
     */
    public function factor()
    {
        return $this->belongsTo(Factor::class);
    }

    /**
     * @return BelongsTo
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    /**
     * @return HasMany
     */
    public function invoiceDocuments()
    {
        return $this->hasMany(InvoiceDocument::class);
    }

    /**
     * @return HasMany
     */
    public function paymentInvoices()
    {
        return $this->hasMany(PaymentInvoice::class);
    }

    /**
     * @return HasMany
     */
    public function scheduleInvoices()
    {
        return $this->hasMany(ScheduleInvoice::class);
    }
}
