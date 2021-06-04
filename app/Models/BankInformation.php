<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\Models;

use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use RichanFongdasen\EloquentBlameable\BlameableTrait;

/**
 * App\Models\BankInformation.
 *
 * @property int $id
 * @property int $company_id
 * @property string $bank_name
 * @property string $account_holder_name
 * @property string $account_number
 * @property string $routing_number
 * @property string $swift_code
 * @property int $created_by
 * @property int $updated_by
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property-read Company $company
 * @property-read User $creator
 * @property-read User|null $updater
 * @method static Builder|Model createdBetween(string $from, string $to)
 * @method static Builder|Model updatedBetween(string $from, string $to)
 * @method static Builder|BankInformation createdBy($userId)
 * @method static Builder|BankInformation updatedBy($userId)
 * @mixin Eloquent
 */
class BankInformation extends Model
{
    use HasFactory;
    use BlameableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'bank_name',
        'account_holder_name',
        'account_number',
        'routing_number',
        'swift_code',
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be cast to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
