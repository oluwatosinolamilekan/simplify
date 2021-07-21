<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Contact;

use App\Models\ContactDetails;
use App\View\Components\ModelForm;

class ContactForm extends ModelForm
{
    public ContactDetails $contact;

    public function render()
    {
        return view('contact.form');
    }

    public function getProperty()
    {
        return 'contact';
    }
}
