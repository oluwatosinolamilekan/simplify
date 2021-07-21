<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Traits;

use Illuminate\Database\Eloquent\Model;
use Livewire\Exceptions\PublicPropertyNotFoundException;
use Livewire\HydrationMiddleware\HashDataPropertiesForDirtyDetection;
use Throwable;

/**
 * Trait WithNested.
 */
trait WithNested
{
    /**
     * @return array
     */
    public function getListeners()
    {
        return array_merge($this->listeners ?? [], [
            'update' => 'update',
            'saved' => 'saved',
        ]);
    }

    /**
     * Saved event listener
     * Likewise Livewire's "updated" hook, it mimics "saved" hook that:
     * - Informs parent component about shared models being saved
     * - Is triggered when nested component save action is called
     * - Marks parent's component property with name $property as existing
     * - If property "foo" is saved and parent component implements savedFoo hook then savedFoo is called for parent component.
     * @param string $property
     */
    public function saved(string $property)
    {
        if ($this->{$property} instanceof Model) {
            $this->{$property}->exists = true;
        }

        $method = 'saved'.ucfirst($property);

        if (method_exists($this, $method)) {
            $this->$method();
        }
    }

    /**
     * Update event listener
     * Mimic Livewire's "updated" hook for properties updated in nested components
     * - Informs parent component about property updates
     * - Properties in parent and nested component need to have *exactly* the same name, otherwise values will not be synchronized.
     * @param $name
     * @param $value
     * @throws Throwable
     */
    public function update($name, $value)
    {
        // Get model attribute to be filled.
        $model = $this->beforeFirstDot($name);

        throw_unless(
            $this->propertyIsPublicAndNotDefinedOnBaseClass($model),
            new PublicPropertyNotFoundException($model, $this::getName())
        );

        if ($this->containsDots($name)) {
            // Strip away model name.
            $attribute = $this->afterFirstDot($name);

            // Get existing data from model property.
            $results = [];
            $results[$model] = data_get($this->{$model}, $attribute, []);

            // Merge in new data.
            data_set($results, $attribute, $value);

            // Re-assign data to model.
            data_set($this->{$model}, $attribute, $results[$attribute]);
        } else {
            $this->{$name} = $value;
        }

        HashDataPropertiesForDirtyDetection::rehashProperty($name, $value, $this);
    }
}
