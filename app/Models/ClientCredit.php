<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\Models;

use App\Enums\CommissionType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

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
        'ucc_date',
        'ucc_date_2',
        'ucc_expiring_date',
        'expiry_date',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast to enum types.
     *
     * @var array
     */
    protected $enumCasts = [
        'type' => CommissionType::class,
    ];

    /**
     * @return BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
