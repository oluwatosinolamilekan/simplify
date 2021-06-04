<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\Models\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

trait UsesTimestampScopes
{
    /**
     * @param Builder $query
     * @param string $from
     * @param string $to
     * @return Builder
     */
    public function scopeCreatedBetween(Builder $query, string $from, string $to): Builder
    {
        return $this->scopeDateAttributeBetween($query, $this->qualifyColumn('created_at'), $from, $to);
    }

    /**
     * @param Builder $query
     * @param string $from
     * @param string $to
     * @return Builder
     */
    public function scopeUpdatedBetween(Builder $query, string $from, string $to): Builder
    {
        return $this->scopeDateAttributeBetween($query, $this->qualifyColumn('updated_at'), $from, $to);
    }

    /**
     * @param Builder $query
     * @param string $attribute
     * @param string $from
     * @param string $to
     * @return Builder
     */
    protected function scopeDateAttributeBetween(Builder $query, string $attribute, string $from, string $to): Builder
    {
        $fromDate = Carbon::parse($from);
        $toDate = Carbon::parse($to);

        /* If provided arguments are strings in date format, rather than in datetime format, parsed values will mark beginning of the day
         * Example: 25-03-2020 after parsed will be 25-03-2020 00:00:00
         * Upper boundary should be end of the day in that case.
         */
        if (! Carbon::hasFormat($to, Carbon::DEFAULT_TO_STRING_FORMAT)) {
            $toDate = $toDate->endOfDay();
        }

        return $query
            ->where($attribute, '>=', $fromDate)
            ->where($attribute, '<=', $toDate);
    }
}
