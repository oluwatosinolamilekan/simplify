<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Traits;

use Livewire\Exceptions\PublicPropertyNotFoundException;
use Livewire\HydrationMiddleware\HashDataPropertiesForDirtyDetection;

trait WithNested
{
    public $nested = [];

    public function getListeners()
    {
        return array_merge($this->listeners ?? [], [
            'update' => 'update',
        ]);
    }

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
