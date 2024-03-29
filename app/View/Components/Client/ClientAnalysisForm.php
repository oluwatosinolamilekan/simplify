<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Client;

use App\Models\ClientAnalysis;
use App\View\Components\ModelForm;

class ClientAnalysisForm extends ModelForm
{
    public ClientAnalysis $analysis;

    public function getProperty()
    {
        return 'analysis';
    }

    public function render()
    {
        return view('clients.analysis.form');
    }
}
