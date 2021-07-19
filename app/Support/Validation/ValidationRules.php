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

/**
 * Class ValidationRules.
 */
class ValidationRules
{
    /**
     * @var string
     */
    public string $property;
    /**
     * @var array|null
     */
    public ?array $rules;

    /**
     * ValidationRules constructor.
     * @param string $property
     * @param array|null $rules
     */
    public function __construct(string $property, ?array $rules = null)
    {
        $this->property = $property;
        $this->rules = $rules;
    }

    /**
     * @param string $property
     * @param Model $instance
     * @param bool $required
     * @return ValidationRules
     */
    public static function forModel(string $property, Model $instance, bool $required = true)
    {
        return new self($property, $instance->getRules($required));
    }

    /**
     * @param string $property
     * @param Model $instance
     * @return mixed
     */
    public static function forCollection(string $property, Model $instance)
    {
        return self::model("{$property}.*", $instance, false);
    }

    /**
     * @param string $property
     * @param array $rules
     * @return ValidationRules
     */
    public static function forProperty(string $property, array $rules)
    {
        return new self($property, $rules);
    }

    /**
     * @return array
     */
    public function getRules()
    {
        return collect($this->rules)
                ->mapWithKeys(fn ($rules, $property) => ["{$this->property}.{$property}" => $rules])
                ->all();
    }

    /**
     * @return string
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * @param mixed ...$params
     * @return array
     */
    public static function merge(...$params)
    {
        return collect($params)
            ->map(fn ($item) => $item instanceof self ? $item->getRules() : $item)
            ->collapse()
            ->all();
    }
}
