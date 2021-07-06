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
use Livewire\Component;

class ContactForm extends Component
{
    public ContactDetails $contact;

    public function render()
    {
        return view('contact.contact-form');
    }

    public function getRules()
    {
        return self::getValidationRules();
    }

    public static function getValidationRules()
    {
        return [
            'contact.emails' => ['array'],
            'contact.emails.*' => ['string', 'email', 'min:8', 'max:255'],
            'contact.phone_numbers' => ['array'],
            'contact.phone_numbers.*' => ['string', 'phone_number:15'],
            'contact.notes' => ['array'],
            'contact.notes.*' => ['string', 'min:2', 'max:125'],
        ];
    }
}
