<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\BankInformation;

use App\Models\BankInformation;
use App\View\Components\ModelForm;

class BankInformationForm extends ModelForm
{
    public BankInformation $bankInformation;

    public function getProperty()
    {
        return 'bankInformation';
    }

    public function render()
    {
        return view('bank-information.form');
    }
}
