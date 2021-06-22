<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\Models;

use App\Enums\CompanyRole;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\ContactPerson.
 *
 * @property int $id
 * @property int $company_id
 * @property string $name
 * @property array|null $emails
 * @property array|null $phone_numbers
 * @property bool $company_role
 * @property array|null $notes
 * @property array|null $meta
 * @property int $created_by
 * @property int $updated_by
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Company $company
 */
class ContactPerson extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'company_id',
        'name',
        'emails',
        'phone_numbers',
        'company_role',
        'notes',
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
        'company_role' => 'int',
        'notes' => 'array',
        'meta' => 'array',
    ];

    /**
     * The attributes that should be cast to enum types.
     *
     * @var array
     */
    protected $enumCasts = [
        'company_role' => CompanyRole::class,
    ];

    /**
     * @return BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
