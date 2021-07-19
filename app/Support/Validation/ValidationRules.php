<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\Support\Validation;

use App\Models\Model;

class ValidationRules
{
    public string $property;
    public ?array $rules;

    public function __construct(string $property, ?array $rules = null)
    {
        $this->property = $property;
        $this->rules = $rules;
    }

    public static function forModel(string $property, Model $instance, bool $required = true)
    {
        return new self($property, $instance->getRules($required));
    }

    public static function forCollection(string $property, Model $instance)
    {
        return self::model("{$property}.*", $instance, false);
    }

    public static function forProperty(string $property, array $rules)
    {
        return new self($property, $rules);
    }

    public function getRules()
    {
        return collect($this->rules)
                ->mapWithKeys(fn ($rules, $property) => ["{$this->property}.{$property}" => $rules])
                ->all();
    }

    public function getProperty()
    {
        return $this->property;
    }

    public static function merge(...$params)
    {
        return collect($params)
            ->map(fn ($item) => $item instanceof self ? $item->getRules() : $item)
            ->collapse()
            ->all();
    }
}
