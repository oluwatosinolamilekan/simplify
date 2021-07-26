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
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

/**
 * App/Models/Vendor.
 *
 * @property int $id
 * @property int $company_id
 * @property int $factor_id
 * @property int $client_id
 * @property string $ref_code
 * @property string $name
 * @property Status $status
 * @property array|null $meta
 * @property int $created_by
 * @property int $updated_by
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Client $client
 * @property Company $company
 * @property Factor $factor
 * @property Invoice[] $invoices
 * @property User $creator
 * @property User $updater
 * @method static Builder|User   createdBy($userId)
 * @method static Builder|User   updatedBy($userId)
 * @method static Builder|Model  createdBetween(string $from, string $to)
 * @method static Builder|Model  updatedBetween(string $from, string $to)
 */
class Vendor extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'company_id',
        'factor_id',
        'client_id',
        'ref_code',
        'name',
        'status',
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
     * @var  array Default values for attributes
     */
    protected $attributes = [
        'status' => Status::Active,
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
     * @return HasOne
     */
    public function settings()
    {
        return $this->hasOne(VendorSettings::class);
    }

    public function getRules(bool $required = true)
    {
        return [
            'name' => [Rule::requiredIf($required), 'string', 'min:2', 'max:255'],
            'ref_code' => [
                Rule::requiredIf($required), 'string', 'min:2', 'max:125',
                Rule::unique('vendors', 'ref_code')->ignore($this->id),
            ],
            'status' => [Rule::requiredIf($required), 'int', Rule::in(StatusTypesList::Vendor)],
            'factor_id' => [Rule::requiredIf($required), 'int', 'exists:factors,id'],
            'client_id' => [Rule::requiredIf($required), 'int', 'exists:clients,id'],
        ];
    }
}
