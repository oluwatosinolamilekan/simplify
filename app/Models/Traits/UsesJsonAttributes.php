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
use Doctrine\DBAL\Types\Type;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\Arr;
use RuntimeException;

/**
 * Trait UsesJsonAttributes.
 */
trait UsesJsonAttributes
{
    /**
     * @param $attribute
     * @return bool
     */
    public function hasJsonAttribute($attribute)
    {
        /** @var Builder $schema */
        $schema = $this->getConnection()->getSchemaBuilder();

        // MySQL converts json type into longtext  (https://github.com/phpmyadmin/phpmyadmin/issues/16221)
        // so check column type from schema would give wrong result
        // it's enough to check whether attribute is array for this purpose
        if (! $schema->hasColumn($this->getTable(), $attribute) || ! $schema->getColumnType($this->getTable(), $attribute) == 'json') {
            return false;
        }

        return true;
    }

    /**
     * @param string $attribute
     * @param $key
     * @param $value
     * @param bool $save
     * @return bool
     */
    public function updateJsonField(string $attribute, $key, $value, bool $save = false)
    {
        if (! $this->hasJsonAttribute($attribute)) {
            throw new RuntimeException("Table {$this->getTable()} does not have {$attribute} attribute defined.");
        }

        $data = $this->{$attribute} ?? [];
        Arr::set($data, $key, $value);
        $this->{$attribute} = $data;

        return $save ? $this->save() : true;
    }

    /**
     * @param string $attribute
     * @param $value
     * @param bool $save
     * @return bool
     */
    public function appendToJson(string $attribute, $value, bool $save = false)
    {
        if (! $this->hasJsonAttribute($attribute)) {
            throw new RuntimeException("Table {$this->getTable()} does not have {$attribute} attribute defined.");
        }

        $data = $this->{$attribute} ?? [];
        $data[] = $value;
        $this->{$attribute} = $data;

        return $save ? $this->save() : true;
    }

    /**
     * @param string $attribute
     * @param string $key
     * @param bool $reindex
     * @param bool $save
     * @return bool
     */
    public function removeJsonField(string $attribute, $key, bool $reindex = false, bool $save = false)
    {
        if (! $this->hasJsonAttribute($attribute)) {
            throw new RuntimeException("Table {$this->getTable()} does not have {$attribute} attribute defined.");
        }

        $data = $this->{$attribute} ?? [];
        Arr::forget($data, $key);
        $this->{$attribute} = $reindex ? array_values($data) : $data;

        return $save ? $this->save() : true;
    }

    /**
     * @param string $attribute
     * @param string $key
     * @param null $default
     * @return array|ArrayAccess|mixed|null
     */
    public function getJsonField(string $attribute, string $key, $default = null)
    {
        if (! $this->hasJsonAttribute($attribute)) {
            return $default;
        }

        return Arr::get($this->{$attribute} ?? [], $key, $default);
    }

    /**
     * @param string $key
     * @param $value
     * @param bool $save
     * @return bool
     */
    public function updateMeta(string $key, $value, bool $save = true)
    {
        return $this->updateJsonField('meta', $key, $value, $save);
    }

    /**
     * @param string $key
     * @param null $default
     * @return array|ArrayAccess|mixed|null
     */
    public function getMeta(string $key, $default = null)
    {
        return $this->getJsonField('meta', $key, $default);
    }
}
