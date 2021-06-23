<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Address;

use App\Models\Address;
use Illuminate\Validation\Rule;
use Livewire\Component;

class AddressForm extends Component
{
    public Address $address;

    public function render()
    {
        return view('address.form');
    }

    public function mount(Address $address)
    {
        $this->address = $address;
    }

    public static function getValidationRules(?Address $model = null)
    {
        $dirty = $model && $model->isDirty();

        return [
            'address.street' => [Rule::requiredIf($dirty), 'string', 'min:2', 'max:255'],
            'address.city' => [Rule::requiredIf($dirty), 'string', 'min:2', 'max:125'],
            'address.state' => [Rule::requiredIf($dirty), 'string', 'min:2', 'max:125'],
            'address.country' => [Rule::requiredIf($dirty), 'string', 'min:2', 'max:125'],
            'address.zip_code' => [Rule::requiredIf($dirty), 'string', 'min:2', 'max:125'],
            'address.mail_code' => [Rule::requiredIf($dirty), 'min:2', 'max:125'],
            'address.timezone' => [Rule::requiredIf($dirty), 'min:2', 'max:125'],
        ];
    }

    public function getRules()
    {
        return self::getValidationRules($this->address);
    }
}
