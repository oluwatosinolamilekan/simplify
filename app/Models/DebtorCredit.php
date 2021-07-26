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
 * App\Models\DebtorCredit.
 *
 * @property int $id
 * @property int $debtor_id
 * @property float $annual_sales
 * @property float $net_worth
 * @property array|null $notes
 * @property array|null $meta
 * @property int $created_by
 * @property int $updated_by
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Debtor $debtor
 * @property User $creator
 * @property User $updater
 * @method static Builder|User   createdBy($userId)
 * @method static Builder|User   updatedBy($userId)
 * @method static Builder|Model  createdBetween(string $from, string $to)
 * @method static Builder|Model  updatedBetween(string $from, string $to)
 */
class DebtorCredit extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'debtor_id',
        'annual_sales',
        'net_worth',
        'notes',
        'meta',
        'created_by',
        'updated_by',
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
    public function debtor()
    {
        return $this->belongsTo(Debtor::class);
    }

    public function getRules(bool $required = true)
    {
        return [
            'debtor_id' => ['int', 'exists:debtors,id'],
            'annual_sales' => [Rule::requiredIf($required), 'numeric'],
            'net_worth' => [Rule::requiredIf($required), 'numeric'],
            'notes' => ['array'],
            'notes.*' => ['string', 'min:2', 'max:255'],
        ];
    }
}
