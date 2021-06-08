<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Traits;

trait ConfirmModelDelete
{
    /**
     * Indicates if deletion is being confirmed.
     *
     * @var bool
     */
    public $confirmingDeletion = false;

    /**
     * Indicates if deletion is completed.
     *
     * @var bool
     */
    public $deleteCompleted = false;

    /**
     * Confirm that the user would like to delete their account.
     *
     * @return void
     */
    public function confirmDeletion()
    {
        $this->resetErrorBag();

        $this->confirmingDeletion = true;
    }

    public function cancelDeletion()
    {
        $this->resetErrorBag();
        $this->confirmingDeletion = false;
    }

    public function deleteModel()
    {
        $this->confirmingDeletion = false;

        $this->resetErrorBag();

        $this->getDeleteModel()->delete();

        $this->deleteCompleted = true;
    }
}
