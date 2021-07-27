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
use Illuminate\Validation\ValidationException;
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
     * - Marks parent's component property with name $property as existing and sets record id
     * - If property "foo" is saved and parent component implements savedFoo hook then savedFoo is called for parent component.
     * @param string $property
     * @param mixed $id
     */
    public function saved(string $property, $id)
    {
        if (! $this->propertyIsPublicAndNotDefinedOnBaseClass($property)) {
            return;
        }

        if ($this->{$property} instanceof Model) {
            $this->{$property}->exists = true;
            $this->{$property}->id = $id;
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

        if (! $this->propertyIsPublicAndNotDefinedOnBaseClass($model)) {
            return;
        }

        if ($this->containsDots($name)) {
            // Strip away model name.
            $attribute = $this->afterFirstDot($name);

            $modelInstance = $this->{$model};

            // Get existing data from model property.
            $results = [];
            $results[$model] = data_get($modelInstance, $attribute, []);

            // Merge in new data.
            data_set($results, $attribute, $value);

            // Strip away all inner properties
            $property = $this->beforeFirstDot($attribute);

            // If property is of type json - no direct modification of json fields is allowed, use methods defined in UsesJsonAttributes trait
            if ($modelInstance->hasJsonAttribute($property) && $this->containsDots($attribute)) {
                $modelInstance->updateJsonField($property, $this->afterFirstDot($attribute), data_get($results, $attribute));
            } else {
                // Re-assign data to model.
                data_set($modelInstance, $attribute, data_get($results, $attribute));
            }
        } else {
            $this->{$name} = $value;
        }

        HashDataPropertiesForDirtyDetection::rehashProperty($name, $value, $this);
    }

    /**
     * Livewire nested components are not reactive as the parent one
     * Therefore, in order to display error bags validation errors need to be propagated to nested components.
     * @param null $rules
     * @param array $messages
     * @param array $attributes
     * @throws ValidationException
     */
    public function validate($rules = null, $messages = [], $attributes = [])
    {
        try {
            parent::validate($rules, $messages, $attributes);
        } catch (\Illuminate\Validation\ValidationException $exception) {

            // inform nested components about validation errors
            $this->emit('validationFail', $exception->validator->getMessageBag());

            // throw ValidationException to prevent further actions
            throw $exception;
        }
    }
}
