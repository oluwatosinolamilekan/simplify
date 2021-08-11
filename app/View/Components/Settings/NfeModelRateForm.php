<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Settings;

use App\Models\NFEModelRate;
use App\Support\Validation\ValidationRules;
use App\View\Components\ModelForm;

class NfeModelRateForm extends ModelForm
{
    public ?NFEModelRate $rate;

    public function render()
    {
        return view('settings.nfe-models.rates.form');
    }

    public function getProperty()
    {
        return $this->rate;
    }

    /**
     * @return array
     */
    public function getRules()
    {
        return ValidationRules::merge(
            ValidationRules::forModel('rate', new NFEModelRate())
        );
    }
}
