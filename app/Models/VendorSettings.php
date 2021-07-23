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
use Illuminate\Validation\Rule;

/**
 * App/Models/VendorSettings.
 *
 * @property int $id
 * @property int $vendor_id
 * @property bool $buy_status
 * @property bool $send_email_remittances
 * @property array|null $meta
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 * @property Vendor $vendor
 * @property User $creator
 * @property User $updater
 * @method static Builder|User   createdBy($userId)
 * @method static Builder|User   updatedBy($userId)
 * @method static Builder|Model  createdBetween(string $from, string $to)
 * @method static Builder|Model  updatedBetween(string $from, string $to)
 */
class VendorSettings extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'vendor_id',
        'buy_status',
        'send_email_remittances',
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
        'meta' => 'array',
    ];

    /**
     * @var  array Default values for attributes
     */
    protected $attributes = [
        'buy_status' => true,
        'send_email_remittances' => true,
    ];

    /**
     * @return BelongsTo
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function getRules(bool $required = true)
    {
        return [
            'vendor_id' => ['int', 'exists:vendors,id'],
            'buy_status' => [Rule::requiredIf($required), 'boolean'],
            'send_email_remittances' => [Rule::requiredIf($required), 'boolean'],
        ];
    }
}
