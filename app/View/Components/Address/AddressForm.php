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
use App\View\Components\ModelForm;

class AddressForm extends ModelForm
{
    public Address $address;

    public function render()
    {
        return view('address.form');
    }

    public function getProperty()
    {
        return 'address';
    }
}
