<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components;

use App\View\Components\Traits\ConfirmModelDelete;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component as BaseComponent;
use Livewire\Exceptions\CannotBindToModelDataWithoutValidationRuleException;
use Livewire\Exceptions\PublicPropertyNotFoundException;
use Livewire\HydrationMiddleware\HashDataPropertiesForDirtyDetection;

class Component extends BaseComponent
{
    use ConfirmModelDelete;

    /* Realtime validation */

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function syncInput($name, $value, $rehash = true)
    {
        $propertyName = $this->beforeFirstDot($name);

        throw_if(
            ($this->{$propertyName} instanceof Model || $this->{$propertyName} instanceof EloquentCollection) && $this->missingRuleFor($name),
            new CannotBindToModelDataWithoutValidationRuleException($name, $this::getName())
        );

        $this->callBeforeAndAfterSyncHooks($name, $value, function ($name, $value) use ($propertyName, $rehash) {
            throw_unless(
                $this->propertyIsPublicAndNotDefinedOnBaseClass($propertyName),
                new PublicPropertyNotFoundException($propertyName, $this::getName())
            );

            $this->syncInputProperty($propertyName, $name, $value);

            $rehash && HashDataPropertiesForDirtyDetection::rehashProperty($name, $value, $this);
        });
    }

    public function syncInputProperty(string $propertyName, string $name, $value)
    {
        if ($this->containsDots($name)) {
            // Strip away component property name.
            $key = $this->afterFirstDot($name); // i.property or i.property.field for collections
                                                // property or property.field for model

            // Get model attribute or collection item to be filled.
            $attribute = $this->beforeFirstDot($key); // i for collection, property for model

            // Get existing data from model property.
            $results = [];
            $results[$attribute] = data_get($this->{$propertyName}, $attribute, []);

            $instance = $this->{$propertyName};
            $property = $key;

            if ($instance instanceof EloquentCollection) {
                $instance = data_get($this->{$propertyName}, $attribute, []);
                $property = $this->afterFirstDot($key);
            }

            if ($this->containsDots($property) && $instance->hasJsonAttribute($this->beforeFirstDot($property))) {
                $instance->updateJsonField($this->beforeFirstDot($property), $this->afterFirstDot($property), $value);
            } else {
                // Merge in new data.
                data_set($results, $key, $value);

                // Re-assign data to model.
                data_set($this->{$propertyName}, $attribute, $results[$attribute]);
            }
        } else {
            $this->{$name} = $value;
        }
    }
}
