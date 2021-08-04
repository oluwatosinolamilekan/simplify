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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Validation\Rule;

/**
 * App\Models\DebtorSettings.
 *
 * @property int $id
 * @property int $debtor_id
 * @property bool $buy_status
 * @property bool $do_not_contact
 * @property string $noa_email
 * @property bool $require_original_invoices
 * @property array|null $warning_notes
 * @property array|null $meta
 * @property int $created_by
 * @property int $updated_by
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Debtor $debtor
 * @property User $creator
 * @property User $updater
 * @method static Builder|User   createdBy($userId)
 * @method static Builder|User   updatedBy($userId)
 * @method static Builder|Model  createdBetween(string $from, string $to)
 * @method static Builder|Model  updatedBetween(string $from, string $to)
 */
class DebtorSettings extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'debtor_id',
        'buy_status',
        'do_not_contact',
        'noa_email',
        'require_original_invoices',
        'warning_notes',
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
        'warning_notes' => 'array',
        'meta' => 'array',
    ];

    /**
     * @var  array Default values for attributes
     */
    protected $attributes = [
        'buy_status' => true,
        'do_not_contact' => true,
        'require_original_invoices' => false,
        'warning_notes' => '[]',
    ];

    /**
     * @return BelongsTo
     */
    public function debtor()
    {
        return $this->belongsTo(Debtor::class);
    }

    public function getRules(bool $required = true)
    {
        return [
            'debtor_id' => ['int', 'exists:debtors,id'],
            'buy_status' => [Rule::requiredIf($required), 'boolean'],
            'do_not_contact' => [Rule::requiredIf($required), 'boolean'],
            'require_original_invoices' => [Rule::requiredIf($required), 'boolean'],
            'noa_email' => [Rule::requiredIf($required), 'string', 'email', 'min:2', 'max:255'],
            'warning_notes' => ['array'],
            'warning_notes.*' => ['required', 'string', 'min:2', 'max:255'],
        ];
    }
}
