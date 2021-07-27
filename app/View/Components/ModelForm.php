<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components;

use App\Support\Validation\ValidationRules;
use App\View\Components\Traits\WithParent;
use Exception;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ModelForm.
 */
abstract class ModelForm extends Component
{
    use WithParent;

    /**
     * If form is partial then properties and actions are being handled by the parent's form
     * Form data is submitted in container form.
     * @var bool
     */
    public bool $partial = false;

    /**
     * @var bool
     */
    public bool $nested = false;

    /**
     * Section slot name in form layout.
     * @var string
     */
    public string $section = 'content';

    /**
     * Component model property.
     * @return mixed
     */
    abstract public function getProperty();

    /**
     * @return mixed
     */
    abstract public function render();

    /**
     * @throws Exception
     * @return mixed
     */
    public function getModel()
    {
        if (! ($this->{$this->getProperty()} instanceof Model)) {
            throw new Exception("Bad property {$this->getProperty()} - not instance of Model");
        }

        return $this->{$this->getProperty()};
    }

    /**
     * Save action for component model.
     */
    public function save()
    {
        $this->validate();

        try {
            $this->getModel()->save();

            $this->successAlert();

            $this->emitUp('saved', $this->getProperty(), $this->getModel()->id);
        } catch (Exception $exception) {
            $this->exceptionAlert($exception);
        }
    }

    /**
     * Validation rules for component model.
     *
     * @throws Exception
     * @return array
     */
    public function getRules()
    {
        $property = $this->getProperty();
        $model = $this->getModel();

        return ValidationRules::forModel($property, $model)->getRules();
    }
}
