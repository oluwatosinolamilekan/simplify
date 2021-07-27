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
use Illuminate\Validation\Rule;

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
class DebtorCreditLimit extends Model
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
        'credit_date:Y-m-d',
        'credit_expiry_date:Y-m-d',
        'created_at',
        'updated_at',
    ];

    /**
     * @var  array Default values for attributes
     */
    protected $attributes = [
        'notes' => '[]',
    ];

    /**
     * @return BelongsTo
     */
    public function debtor()
    {
        return $this->belongsTo(Debtor::class);
    }

    public function getRules(bool $required = true)
    {
        return [
            'id' => ['int'],
            'debtor_id' => ['int', 'exists:debtors,id'],
            'all_customer_limit' => [Rule::requiredIf($required), 'numeric'],
            'months_good_for' => ['int', 'min:0', 'max:360'],
            'credit_date' => [Rule::requiredIf($required), 'date', 'date_format:Y-m-d', 'before:creditLimit.credit_expiry_date'],
            'credit_expiry_date' => [Rule::requiredIf($required), 'date', 'date_format:Y-m-d', 'after:creditLimit.credit_date'],
            'notes' => ['array'],
            'notes.*' => ['string', 'min:2', 'max:255'],
        ];
    }

    public function calcMonthsGoodFor()
    {
        if (! $this->credit_date || ! $this->credit_expiry_date) {
            return;
        }

        $this->months_good_for = (new Carbon($this->credit_expiry_date))->diffInMonths(new Carbon($this->credit_date));
    }
}
