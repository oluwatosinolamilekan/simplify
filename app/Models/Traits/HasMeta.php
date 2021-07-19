<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\Models\Traits;

use ArrayAccess;
use Illuminate\Support\Arr;
use RuntimeException;

trait HasMeta
{
    /**
     * @return bool
     */
    public function hasMetaAttribute()
    {
        $schema = $this->getConnection()->getSchemaBuilder();

        if (! $schema->hasColumn($this->getTable(), 'meta')) {
            return false;
        }

        return true;
    }

    /**
     * @param string $key
     * @param $value
     * @param bool $save
     * @return bool
     */
    public function updateMeta(string $key, $value, bool $save = true)
    {
        if (! $this->hasMetaAttribute()) {
            throw new RuntimeException("Table {$this->getTable()} does not have meta_info attribute defined.");
        }

        $meta = $this->meta ?? [];
        Arr::set($meta, $key, $value);
        $this->meta = $meta;

        return $save ? $this->save() : true;
    }

    /**
     * @param string $key
     * @param null $default
     * @return array|ArrayAccess|mixed|null
     */
    public function getMeta(string $key, $default = null)
    {
        if (! $this->hasMetaAttribute()) {
            return $default;
        }

        return Arr::get($this->meta ?? [], $key, $default);
    }
}
