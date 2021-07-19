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
use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;

/**
 * App\Models\Company.
 *
 * @property int        $id
 * @property string     $name
 * @property string     $domain
 * @property Status     $status
 * @property array|null $meta
 * @property int        $created_by
 * @property int        $updated_by
 * @property Carbon     $created_at
 * @property Carbon|null $updated_at
 * @property User       $creator
 * @property User       $updater
 * @property Address    $address
 * @property User[]     $users
 * @property ContactDetails  $contactDetails
 * @property BankInformation[] $bankInformation
 * @property CompanyIdentity $identity
 * @method static Company           active()
 * @method static Builder|Company   createdBy($userId)
 * @method static Builder|Company   updatedBy($userId)
 * @method static Builder|Model     createdBetween(string $from, string $to)
 * @method static Builder|Model     updatedBetween(string $from, string $to)
 * @mixin Eloquent
 */
class Company extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'domain',
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

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function contactDetails()
    {
        return $this->hasOne(ContactDetails::class);
    }

    public function bankInformation()
    {
        return $this->hasMany(BankInformation::class);
    }

    public function identity()
    {
        return $this->hasOne(CompanyIdentity::class);
    }

    public function users()
    {
        return $this->hasManyThrough(
            User::class,
            UserCompanyAccess::class,
            'company_id',
            'id',
            'id',
            'user_id'
        );
    }

    public function getRules(bool $required = true)
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'domain' => ['required', 'string', 'min:2', 'max:125',
                $this->exists ? Rule::unique('companies', 'domain')->ignore($this->id) : 'unique:companies,domain',
            ],
        ];
    }
}
