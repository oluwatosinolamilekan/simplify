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
use App\Models\Traits\MustConfigurePassword;
use App\Models\Traits\UsesJsonAttributes;
use App\Models\Traits\UsesTimestampScopes;
use BenSampo\Enum\Traits\CastsEnums;
use Eloquent;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Laravel\Fortify\TwoFactorAuthenticatable;

/**
 * App\Models\User.
 *
 * @property int $id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string $email
 * @property string $password
 * @property Status $status
 * @property Role $role
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property array|null $meta
 * @property string|null $remember_token
 * @property Carbon $email_verified_at
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property-read string $full_name Get User's full name
 * @property-read array $preferences Get User's preferences
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static Builder|User active()
 * @method static Builder|Model createdBetween(string $from, string $to)
 * @method static Builder|Model updatedBetween(string $from, string $to)
 * @mixin Eloquent
 *
 * * @property-read Company $company Get User's company
 */
class User extends Authenticatable implements MustVerifyEmailContract
{
    use HasFactory;
    use Notifiable;
    use MustVerifyEmail;
    use MustConfigurePassword;
    use TwoFactorAuthenticatable;
    use CastsEnums;
    use UsesTimestampScopes;
    use UsesJsonAttributes;

    /**
     * @var bool do not allow timestamps management. They are already being done by database.
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'status',
        'role',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'meta',
        'remember_token',
    ];

    /**
     * @var  array Default values for attributes
     */
    protected $attributes = [
        'status' => Status::Active,
        'role' => Role::CompanyUser,
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'int',
        'role' => 'int',
        'meta' => 'array',
        'email_verified_at' => 'datetime',
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
        'email_verified_at',
        'created_at',
        'updated_at',
    ];

    /**
     * @comment Get User's full name
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * @comment Get User's company domain
     *
     * @return string
     */
    public function getSubdomainAttribute(): ?string
    {
        return $this->company->domain ?? null;
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', Status::Active);
    }

    // TODO: user can belong to multiple companies
    public function company(): HasOneThrough
    {
        return $this->hasOneThrough(
            Company::class,
            UserCompanyAccess::class,
            'user_id',
            'id',
            'id',
            'company_id'
        );
    }

    public function getPreferencesAttribute()
    {
        return $this->meta['preferences'] ?? [];
    }

    public function getRules(bool $required = true)
    {
        $dirty = $this->isDirty();

        return [
            'first_name' => ['string', 'min:2', 'max:255'],
            'last_name' => ['string', 'min:2', 'max:255'],
            'email' => [
                Rule::requiredIf($required || $dirty), 'string', 'email', 'min:8', 'max:255',
                Rule::unique('users', 'email')->ignore($this->id),
            ],
            'role' => [Rule::requiredIf($required || $dirty), 'int'],
            'status' => [Rule::requiredIf($required || $dirty), 'int', Rule::in([Status::Active, Status::NotActive])],
        ];
    }

    public function isDirty($attributes = [])
    {
        if (! $this->exists) {
            return ! empty(array_filter($this->getDirty()));
        }

        return parent::isDirty($attributes);
    }
}
