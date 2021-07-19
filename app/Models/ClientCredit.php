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
 * App\Models\ClientCredit.
 *
 * @property int $id
 * @property int $client_id
 * @property bool $approved
 * @property string $credit_rating
 * @property float $credit_limit
 * @property float $debtor_limit
 * @property float $debtor_concentration
 * @property int $standard_terms
 * @property int $ineligible_days
 * @property bool $report_charge
 * @property float $report_charge_amount
 * @property string $ucc_date
 * @property string $ucc_date_2
 * @property string $ucc_expiring_date
 * @property array|null $meta
 * @property int $created_by
 * @property int $updated_by
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Client $client
 * @property User $creator
 * @property User $updater
 * @method static Builder|User   createdBy($userId)
 * @method static Builder|User   updatedBy($userId)
 * @method static Builder|Model  createdBetween(string $from, string $to)
 * @method static Builder|Model  updatedBetween(string $from, string $to)
 */
class ClientCredit extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'client_credit';

    /**
     * @var array
     */
    protected $fillable = [
        'client_id',
        'approved',
        'credit_rating',
        'credit_limit',
        'debtor_limit',
        'debtor_concentration',
        'standard_terms',
        'ineligible_days',
        'report_charge',
        'report_charge_amount',
        'ucc_date',
        'ucc_date_2',
        'ucc_expiring_date',
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
        'meta' => 'array',
    ];

    /**
     * The attributes that should be cast to dates.
     *
     * @var array
     */
    protected $dates = [
        'ucc_date:Y-m-d',
        'ucc_date_2:Y-m-d',
        'ucc_expiring_date:Y-m-d',
        'created_at',
        'updated_at',
    ];

    /**
     * @var  array Default values for attributes
     */
    protected $attributes = [
        'standard_terms' => 30,
        'ineligible_days' => 0,
    ];

    /**
     * @return BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function getRules(bool $required = true)
    {
        $dirty = $this && $this->isDirty();

        return [
            'approved' => [Rule::requiredIf($required || $dirty), 'boolean'],
            'credit_rating' => [Rule::requiredIf($required || $dirty), 'string', 'min:2', 'max:255'],
            'credit_limit' => [Rule::requiredIf($required || $dirty), 'numeric'],
            'debtor_limit' => [Rule::requiredIf($required || $dirty), 'numeric'],
            'debtor_concentration' => [Rule::requiredIf($required || $dirty), 'numeric'],
            'standard_terms' => [Rule::requiredIf($required || $dirty), 'numeric'],
            'ineligible_days' => [Rule::requiredIf($required || $dirty), 'numeric'],
            'report_charge' => [Rule::requiredIf($required || $dirty), 'boolean'],
            'report_charge_amount' => [Rule::requiredIf($required || $dirty), 'numeric', 'min:0', 'max:10000'],
            'ucc_date' => [Rule::requiredIf($required || $dirty), 'date'],
            'ucc_date_2' => [Rule::requiredIf($required || $dirty), 'date'],
            'ucc_expiring_date' => [Rule::requiredIf($required || $dirty), 'date'],
        ];
    }
}
