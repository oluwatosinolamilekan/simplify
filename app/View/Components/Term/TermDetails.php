<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Term;

use App\Models\Term;
use App\View\Components\Component;
use App\View\Components\Traits\ConfirmModelDelete;
use Exception;

class TermDetails extends Component
{
    use ConfirmModelDelete;

    public Term $term;

    /**
     * @param  $term_id
     * @throws Exception
     */
    public function mount($term_id = null)
    {
        $this->term = Term::with([
            'settings',
            'feeRules',
            'clients',
        ])->findOrNew($term_id);
    }

    public function render()
    {
        return view('terms.details');
    }
}
