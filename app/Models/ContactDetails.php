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

/**
 * App\Models\ContactDetail.
 *
 * @property int $id
 * @property int $company_id
 * @property array $emails
 * @property array $phone_numbers
 * @property array|null $notes
 * @property array|null $meta
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property-read Company $company
 * @property-read User $creator
 * @property-read User $updater
 * @method static Builder|Model createdBetween(string $from, string $to)
 * @method static Builder|Model updatedBetween(string $from, string $to)
 * @method static Builder|ContactDetails createdBy($userId)
 * @method static Builder|ContactDetails updatedBy($userId)
 * @mixin Eloquent
 */
class ContactDetails extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contact_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'emails',
        'phone_numbers',
        'notes',
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
        'emails' => 'array',
        'phone_numbers' => 'array',
        'notes' => 'array',
        'meta' => 'array',
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
