<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Company;

use App\Models\Company;
use App\View\Components\ModelForm;

class CompanyForm extends ModelForm
{
    public Company $company;

    public function render()
    {
        return view('companies.form');
    }

    public function getProperty()
    {
        return 'company';
    }
}
