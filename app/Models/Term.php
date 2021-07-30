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
use App\Enums\StatusTypesList;
use App\Enums\TermType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

/**
 * App\Models\Term.
 *
 * @property int $id
 * @property int $factor_id
 * @property string $name
 * @property string $code
 * @property TermType $type
 * @property Status $status
 * @property array|null $meta
 * @property int $created_by
 * @property int $updated_by
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Factor $factor
 * @property Client[] $clients
 * @property TermSettings[] $settings
 * @property FeeRule[] $feeRules
 * @property User $creator
 * @property User $updater
 * @method static Builder|User   createdBy($userId)
 * @method static Builder|User   updatedBy($userId)
 * @method static Builder|Model  createdBetween(string $from, string $to)
 * @method static Builder|Model  updatedBetween(string $from, string $to)
 */
class Term extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'factor_id',
        'name',
        'code',
        'type',
        'status',
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
        'type' => 'int',
        'status' => 'int',
        'meta' => 'array',
    ];

    /**
     * The attributes that should be cast to enum types.
     *
     * @var array
     */
    protected $enumCasts = [
        'type' => TermType::class,
        'status' => Status::class,
    ];

    /**
     * @var  array Default values for attributes
     */
    protected $attributes = [
        'status' => Status::Active,
        'type' => TermType::Other,
    ];

    /**
     * @return BelongsTo
     */
    public function factor()
    {
        return $this->belongsTo(Factor::class);
    }

    /**
     * @return BelongsToMany
     */
    public function clients()
    {
        return $this->belongsToMany(Client::class, ClientTerm::class);
    }

    /**
     * @return HasOne
     */
    public function settings()
    {
        return $this->hasOne(TermSettings::class);
    }

    /**
     * @return HasMany
     */
    public function feeRules()
    {
        return $this->hasMany(FeeRule::class, 'term_id');
    }

    public function getRules(bool $required = true)
    {
        return [
            'name' => [Rule::requiredIf($required), 'string', 'min:2', 'max:255'],
            'code' => [
                Rule::requiredIf($required), 'string', 'min:2', 'max:125',
                Rule::unique('terms', 'code')->ignore($this->id),
            ],
            'status' => [Rule::requiredIf($required), 'int', Rule::in(StatusTypesList::Term)],
            'type' => [Rule::requiredIf($required), 'int', Rule::in(TermType::getValues())],
            'factor_id' => [Rule::requiredIf($required), 'int', 'exists:factors,id'],
        ];
    }
}
