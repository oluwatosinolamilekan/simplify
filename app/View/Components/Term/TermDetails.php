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
use App\Models\TermSettings;
use App\Support\Validation\ValidationRules;
use App\View\Components\Component;
use App\View\Components\Traits\ConfirmModelDelete;
use App\View\Components\Traits\WithNested;
use Exception;

class TermDetails extends Component
{
    use ConfirmModelDelete;
    use WithNested;

    public Term $term;
    public TermSettings $settings;

    /**
     * @param  $term_id
     * @throws Exception
     */
    public function mount($term_id = null)
    {
        $this->term = Term::with([
            'settings',
        ])->findOrNew($term_id);

        $this->initRelated();
    }

    public function render()
    {
        return view('terms.details');
    }

    public function initRelated()
    {
        $this->settings = $this->term->getRelatedInstanceOrNew('settings');
    }

    public function getRules()
    {
        /** Ignore term_id change as term_id is set by default */
        $this->settings->isDirty('term_id') && $this->settings->ignoreDirty('term_id');

        return ValidationRules::merge(
            parent::getRules(),
            ValidationRules::forModel('settings', $this->settings, $this->settings->isDirty())
        );
    }
}
