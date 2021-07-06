<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\Models;

use App\Enums\ClientType;
use App\Enums\Status;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * App\Models\Client.
 *
 * @property int $id
 * @property int $company_id
 * @property int $factor_id
 * @property string $ref_code
 * @property string $name
 * @property ClientType $type
 * @property Status $status
 * @property array|null $meta
 * @property int $created_by
 * @property int $updated_by
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Company $company
 * @property Factor $factor
 * @property BatchReceivable[] $batchPayments
 * @property ClientAnalysis[] $analysis
 * @property ClientCommission[] $commissions
 * @property ClientContractDocument[] $contractDocuments
 * @property ClientContract[] $ccontracts
 * @property ClientCredit[] $credits
 * @property ClientFundingInstructions[] $fundingInstructions
 * @property ClientIntegrations[] $integrations
 * @property ClientTransactionFee[] $transactionFees
 * @property Debtor[] $debtors
 * @property Invoice[] $invoices
 * @property Payment[] $payments
 * @property Schedule[] $schedules
 * @property Team[] $teams
 * @property Vendor[] $vendors
 * @property User $creator
 * @property User $updater
 * @method static Builder|User   createdBy($userId)
 * @method static Builder|User   updatedBy($userId)
 * @method static Builder|Model  createdBetween(string $from, string $to)
 * @method static Builder|Model  updatedBetween(string $from, string $to)
 */
class Client extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'company_id',
        'factor_id',
        'ref_code',
        'name',
        'type',
        'status',
        'meta',
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'type' => 'int',
        'status' => 'int',
        'meta' => 'array',
    ];

    /**
     * @var  array Default values for attributes
     */
    protected $attributes = [
        'status' => Status::Active,
        'type' => ClientType::Other,
    ];

    /**
     * The attributes that should be cast to enum types.
     *
     * @var array
     */
    protected $enumCasts = [
        'type' => ClientType::class,
        'status' => Status::class,
    ];

    /**
     * @return BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
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
    public function batchPayments()
    {
        return $this->hasMany(BatchReceivable::class);
    }

    /**
     * @return HasOne
     */
    public function analysis()
    {
        return $this->hasOne(ClientAnalysis::class);
    }

    /**
     * @return HasMany
     */
    public function commissions()
    {
        return $this->hasMany(ClientCommission::class);
    }

    /**
     * @return HasMany
     */
    public function contractDocuments()
    {
        return $this->hasMany(ClientContractDocument::class);
    }

    /**
     * @return HasMany
     */
    public function contracts()
    {
        return $this->hasMany(ClientContract::class);
    }

    /**
     * @return HasMany
     */
    public function credits()
    {
        return $this->hasMany(ClientCredit::class);
    }

    /**
     * @return HasMany
     */
    public function fundingInstructions()
    {
        return $this->hasMany(ClientFundingInstructions::class);
    }

    /**
     * @return HasMany
     */
    public function integrations()
    {
        return $this->hasMany(ClientIntegrations::class);
    }

    /**
     * @return HasMany
     */
    public function transactionFees()
    {
        return $this->hasMany(ClientTransactionFee::class);
    }

    /**
     * @return HasMany
     */
    public function vendors()
    {
        return $this->hasMany(Vendor::class);
    }

    /**
     * @return HasMany
     */
    public function debtors()
    {
        return $this->hasMany(Debtor::class);
    }

    /**
     * @return HasMany
     */
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    /**
     * @return HasManyThrough
     */
    public function teams()
    {
        return $this->hasManyThrough(Team::class, TeamClient::class);
    }
}
