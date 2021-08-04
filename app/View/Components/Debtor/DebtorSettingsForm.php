<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Debtor;

use App\Models\DebtorSettings;
use App\View\Components\ModelForm;

class DebtorSettingsForm extends ModelForm
{
    public DebtorSettings $settings;

    public ?string $note = null;

    public function mount(DebtorSettings $settings)
    {
        $this->settings = $settings;
    }

    public function render()
    {
        return view('debtors.settings.form');
    }

    public function getProperty()
    {
        return 'settings';
    }

    public function addNote()
    {
        $this->validateOnly(
            'note',
            ['note' => $this->getRules()['settings.warning_notes.*']],
            ['note.required' => 'Empty notes are not allowed.']
        );

        $this->settings->appendToJson('warning_notes', $this->note);

        $this->updatedWithParent('settings.warning_notes', $this->settings->warning_notes); // inform parent about update

        $this->note = '';
    }

    public function deleteNote($index)
    {
        $this->settings->removeJsonField('warning_notes', $index, true);

        $this->updatedWithParent('settings.warning_notes', $this->settings->warning_notes); // inform parent about update
    }

    public function getMessages()
    {
        return [
            'warning_notes.*.required' => 'Empty notes are not allowed.',
        ];
    }
}
