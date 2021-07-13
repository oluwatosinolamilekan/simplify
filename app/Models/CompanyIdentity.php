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
 * App\Models\CompanyIdentity.
 *
 * @property int $id
 * @property int $company_id
 * @property string $alternate_name
 * @property string $company_code
 * @property string $mc_number
 * @property string $dot_number
 * @property string $fed_tax_id
 * @property string $duns_id
 * @property string $edi_id
 * @property array|null $meta
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 * @property Company $company
 * @property User $creator
 * @property User $updater
 * @method static Builder|User   createdBy($userId)
 * @method static Builder|User   updatedBy($userId)
 * @method static Builder|Model  createdBetween(string $from, string $to)
 * @method static Builder|Model  updatedBetween(string $from, string $to)
 */
class CompanyIdentity extends Model
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'meta' => 'array',
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'company_id',
        'alternate_name',
        'company_code',
        'mc_number',
        'dot_number',
        'fed_tax_id',
        'duns_id',
        'edi_id',
        'meta',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];

    /**
     * @return BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function getRules(bool $required = false)
    {
        $dirty = $this->isDirty();

        return [
            'companyIdentity.company_code' => [
                'string', 'min:2', 'max:255',
                $this->exists && $this->id ? Rule::unique('company_identities', 'company_code')->ignore($this->id) : 'unique:company_identities,company_code',
            ],
            'companyIdentity.alternate_name' => ['string', 'min:2', 'max:255'],
            'companyIdentity.mc_number' => [Rule::requiredIf($required || $dirty), 'string', 'min:2', 'max:125'],
            'companyIdentity.dot_number' => [Rule::requiredIf($required || $dirty), 'string', 'min:2', 'max:125'],
            'companyIdentity.fed_tax_id' => ['string', 'min:2', 'max:125'],
            'companyIdentity.duns_id' => ['string', 'min:2', 'max:125'],
            'companyIdentity.edi_id' => ['string', 'min:2', 'max:125'],
        ];
    }
}
