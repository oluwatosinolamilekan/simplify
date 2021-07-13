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
use Illuminate\Validation\Rule;

/**
 * App\Models\Address.
 *
 * @property int $id
 * @property int $company_id
 * @property string $street
 * @property string $city
 * @property string $state
 * @property string $country
 * @property string $zip_code
 * @property string $mail_code
 * @property string $timezone
 * @property array|null $meta
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property-read Company $company
 * @property-read User $creator
 * @property-read User $updater
 * @method static Builder|Model createdBetween(string $from, string $to)
 * @method static Builder|Model updatedBetween(string $from, string $to)
 * @method static Builder|Address createdBy($userId)
 * @method static Builder|Address updatedBy($userId)
 * @mixin Eloquent
 */
class Address extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'street',
        'city',
        'state',
        'country',
        'zip_code',
        'mail_code',
        'timezone',
        'meta',
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'meta' => 'array',
    ];

    /**
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function getRules(bool $required = true)
    {
        $dirty = $this->isDirty();

        return [
            'address.street' => [Rule::requiredIf($required || $dirty), 'string', 'min:2', 'max:255'],
            'address.city' => [Rule::requiredIf($required || $dirty), 'string', 'min:2', 'max:125'],
            'address.state' => [Rule::requiredIf($required || $dirty), 'string', 'min:2', 'max:125'],
            'address.country' => [Rule::requiredIf($required || $dirty), 'string', 'min:2', 'max:125'],
            'address.zip_code' => [Rule::requiredIf($required || $dirty), 'string', 'min:2', 'max:125'],
            'address.mail_code' => [Rule::requiredIf($required || $dirty), 'min:2', 'max:125'],
            'address.timezone' => [Rule::requiredIf($required || $dirty), 'min:2', 'max:125'],
        ];
    }
}
