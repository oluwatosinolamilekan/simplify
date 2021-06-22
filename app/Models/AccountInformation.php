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

/**
 * App\Models\AccountInformation.
 *
 * @property int $user_id
 * @property int $company_id
 * @property string $first_name
 * @property string $last_name
 * @property string $middle_name
 * @property array|null $emails
 * @property array|null $phone_numbers
 * @property array|null $meta
 * @property int $created_by
 * @property int $updated_by
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Company $company
 * @property User $user
 * @property User $creator
 * @property User $updater
 * @method static Builder|User   createdBy($userId)
 * @method static Builder|User   updatedBy($userId)
 * @method static Builder|Model  createdBetween(string $from, string $to)
 * @method static Builder|Model  updatedBetween(string $from, string $to)
 */
class AccountInformation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'account_information';

    /**
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'emails',
        'phone_numbers',
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
        'emails' => 'array',
        'phone_numbers' => 'array',
        'meta' => 'array',
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
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
