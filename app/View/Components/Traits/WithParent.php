<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Traits;

use Illuminate\Validation\ValidationException;

trait WithParent
{
    /**
     * @return array
     */
    public function getListeners()
    {
        return array_merge($this->listeners ?? [], [
            'validationFail' => 'validationFail',
        ]);
    }
    /**
     * Livewire "updated" hook
     * Informs parent component about property changes
     * Properties in parent and nested components need to have *exactly* the same name, otherwise values will not be synchronized.
     * @param $name
     * @param $value
     */
    public function updatedWithParent($name, $value)
    {
        // Inform parent component about the change
        $this->emitUp('update', $name, $value);
    }

    /**
     * If parent validation failed - display error bags.
     * @param $messages
     * @throws ValidationException
     */
    public function validationFail($messages)
    {
        throw ValidationException::withMessages($messages);
    }

    /**
     * Component's validateOnly method throws exception that prevents further actions and therefore changes are not propagated to the parent
     * Yet parent component needs to be aware of invalid input during the save action for example
     * This method overrides validateOnly so that it pass property value to the parent component first.
     * @param $field
     * @param null $rules
     * @param array $messages
     * @param array $attributes
     * @throws ValidationException
     */
    public function validateOnly($field, $rules = null, $messages = [], $attributes = [])
    {
        // first propagate change to the parent
        $this->updatedWithParent($field, data_get($this, $field));

        parent::validateOnly($field, $rules, $messages, $attributes);
    }
}
