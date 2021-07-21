<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Client;

use App\Models\ClientCredit;
use App\View\Components\ModelForm;

class ClientCreditForm extends ModelForm
{
    public ClientCredit $credit;

    public function getProperty()
    {
        return 'credit';
    }

    public function render()
    {
        return view('client.credit.form');
    }
}
