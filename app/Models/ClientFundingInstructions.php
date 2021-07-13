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
use Illuminate\Validation\Rule;

/**
 * App\Models\ClientFundingInstructions.
 *
 * @property int $id
 * @property int $client_id
 * @property bool $generate_invoice
 * @property bool $send_invoice
 * @property bool $efs_available
 * @property float $fuel_advance_fee
 * @property float $fuel_advance_max_rate
 * @property float $funding_limit
 * @property array|null $notes
 * @property float $max_invoice_amount
 * @property bool $outsource_collections
 * @property bool $allow_fundings
 * @property bool $allow_reserve_release
 * @property bool $send_email_remittances
 * @property string $schedule_submission_email
 * @property array|null $warning_notes
 * @property array|null $meta
 * @property int $created_by
 * @property int $updated_by
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Client $client
 * @property User $creator
 * @property User $updater
 * @method static Builder|User   createdBy($userId)
 * @method static Builder|User   updatedBy($userId)
 * @method static Builder|Model  createdBetween(string $from, string $to)
 * @method static Builder|Model  updatedBetween(string $from, string $to)
 */
class ClientFundingInstructions extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'client_id',
        'generate_invoice',
        'send_invoice',
        'efs_available',
        'fuel_advance_fee',
        'fuel_advance_max_rate',
        'funding_limit',
        'notes',
        'max_invoice_amount',
        'outsource_collections',
        'allow_fundings',
        'allow_reserve_release',
        'send_email_remittances',
        'schedule_submission_email',
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
        'funding_notes' => 'array',
    ];

    /**
     * @var  array Default values for attributes
     */
    protected $attributes = [
        'generate_invoice' => true,
        'send_invoice' => true,
        'efs_available' => false,
        'fuel_advance_fee' => 0,
        'fuel_advance_max_rate' => 0,
        'allow_fundings' => true,
        'allow_reserve_releases' => true,
        'send_email_remittances' => true,
        'warning_notes' => '[]',
        'funding_notes' => '[]',
    ];

    /**
     * @return BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function getRules(bool $required = true)
    {
        $dirty = $this && $this->isDirty();

        return [
            'fundingInstructions.generate_invoice' => [Rule::requiredIf($required || $dirty), 'boolean'],
            'fundingInstructions.send_invoice' => [Rule::requiredIf($required || $dirty), 'boolean'],
            'fundingInstructions.efs_available' => [Rule::requiredIf($required || $dirty), 'boolean'],
            'fundingInstructions.fuel_advance_fee' => [Rule::requiredIf($required || $dirty), 'numeric'],
            'fundingInstructions.fuel_advance_max_rate' => ['numeric', 'min:0', 'max:100'],
            'fundingInstructions.max_invoice_amount' => [Rule::requiredIf($required || $dirty), 'numeric', 'min:0', 'max:10000'],
            'fundingInstructions.allow_fundings' => [Rule::requiredIf($required || $dirty), 'boolean'],
            'fundingInstructions.allow_reserve_releases' => [Rule::requiredIf($required || $dirty), 'boolean'],
            'fundingInstructions.funding_limit' => [Rule::requiredIf($required || $dirty), 'numeric', 'min:0', 'max:10000'],
            'fundingInstructions.funding_notes' => ['array'],
            'fundingInstructions.funding_notes.*' => ['string', 'min:2', 'max:255'],
            'fundingInstructions.outsource_collections' => [Rule::requiredIf($required || $dirty), 'boolean'],
            'fundingInstructions.send_email_remittances' => [Rule::requiredIf($required || $dirty), 'boolean'],
            'fundingInstructions.schedule_submission_email' => ['string', 'email', 'min:2', 'max:255'],
            'fundingInstructions.warning_notes' => ['array'],
            'fundingInstructions.warning_notes.*' => ['string', 'min:2', 'max:255'],
        ];
    }
}
