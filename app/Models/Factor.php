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
use App\Enums\StatusTypesList;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

/**
 * App\Models\Factor.
 *
 * @property int $id
 * @property int $company_id
 * @property int $subscription_plan_id
 * @property string $ref_code
 * @property Status $status
 * @property array|null $meta
 * @property int $created_by
 * @property int $updated_by
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Company $company
 * @property BatchReceivable[] $batchReceivables
 * @property Client[] $clients
 * @property Debtor[] $debtors
 * @property Invoice[] $invoices
 * @property Payment[] $payments
 * @property Schedule[] $schedules
 * @property Team[] $teams
 * @property Term[] $terms
 * @property Vendor[] $vendors
 * @property SubscriptionPlan $subscriptionPlan
 * @property User $creator
 * @property User $updater
 * @method static Builder|User   createdBy($userId)
 * @method static Builder|User   updatedBy($userId)
 * @method static Builder|Model  createdBetween(string $from, string $to)
 * @method static Builder|Model  updatedBetween(string $from, string $to)
 */
class Factor extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'company_id',
        'subscription_plan_id',
        'ref_code',
        'status',
        'meta',
        'created_by',
        'updated_by',
    ];

    /**
     * @var  array Default values for attributes
     */
    protected $attributes = [
        'status' => Status::Active,
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'int',
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
     * @return BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    /**
     * @return BelongsTo
     */
    public function subscriptionPlan()
    {
        return $this->belongsTo(SubscriptionPlan::class);
    }

    /**
     * @return HasMany
     */
    public function batchReceivables()
    {
        return $this->hasMany(BatchReceivable::class);
    }

    /**
     * @return HasMany
     */
    public function clients()
    {
        return $this->hasMany(Client::class);
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
     * @return HasMany
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * @return HasMany
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    /**
     * @return HasMany
     */
    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    /**
     * @return HasMany
     */
    public function terms()
    {
        return $this->hasMany(Term::class);
    }

    /**
     * @return HasMany
     */
    public function vendors()
    {
        return $this->hasMany(Vendor::class);
    }

    public function getRules(bool $required = true)
    {
        return [
            'ref_code' => [
                Rule::requiredIf($required), 'string', 'min:2', 'max:125',
                $this->exists && $this->id ? Rule::unique('factors', 'ref_code')->ignore($this->id) : 'unique:factors,ref_code',
            ],
            'status' => [Rule::requiredIf($required), 'int', Rule::in(StatusTypesList::Factor)],
            'subscription_plan_id' => [Rule::requiredIf($required), 'exists:subscription_plans,id'],
        ];
    }
}
