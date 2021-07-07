<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\Models;

use App\Enums\Role;
use App\Enums\Status;
use Awobaz\Compoships\Compoships;
use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use RichanFongdasen\EloquentBlameable\BlameableTrait;

/**
 * App\Models\UserCompanyAccess.
 *
 * @property int $id
 * @property int $user_id
 * @property int $company_id
 * @property Status $status
 * @property Role $role
 * @property array|null $permissions
 * @property string $first_name
 * @property string $last_name
 * @property string $middle_name
 * @property array|null $emails
 * @property array|null $phone_numbers
 * @property array|null $meta
 * @property int $created_by
 * @property int $updated_by
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @method static UserCompanyAccess active()
 * @property-read Company $company
 * @property-read User $creator
 * @property-read User $updater
 * @property-read User $user
 * @method static Builder|Model createdBetween(string $from, string $to)
 * @method static Builder|Model updatedBetween(string $from, string $to)
 * @method static Builder|UserCompanyAccess createdBy($userId)
 * @method static Builder|UserCompanyAccess updatedBy($userId)
 * @mixin Eloquent
 */
class UserCompanyAccess extends Model
{
    use HasFactory;
    use BlameableTrait;
    use Compoships;

    public $table = 'user_company_access';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'company_id',
        'status',
        'role',
        'permissions',
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
     * @var  array Default values for attributes
     */
    protected $attributes = [
        'status' => Status::Active,
        'role' => Role::Employee,
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'int',
        'role' => 'int',
        'permissions' => 'array',
        'emails' => 'array',
        'phone_numbers' => 'array',
        'meta' => 'array',
    ];

    /**
     * The attributes that should be cast to enum types.
     *
     * @var array
     */
    protected $enumCasts = [
        'status' => Status::class,
        'role' => Role::class,
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
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', Status::Active);
    }

    /**
     * Set the keys for a save query.
     *
     * @param Builder $query
     * @return Builder
     */
    protected function setKeysForSaveQuery($query): Builder
    {
        $query
            ->where('user_id', '=', $this->getAttribute('user_id'))
            ->where('company_id', '=', $this->getAttribute('company_id'));

        return $query;
    }
}
