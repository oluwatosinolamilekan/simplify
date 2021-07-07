<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Traits;

use App\View\Components\Common\Datatable;
use Throwable;
use URL;

trait ConfirmModelDelete
{
    use WithAlerts;

    /* Previous URL for redirection after delete  */
    public $previous = null;

    /**
     * Previous URL is saved on mounting because Laravel back() method doesn't work with Livewire.
     *
     * @return void
     */
    public function mountConfirmModelDelete()
    {
        $this->previous = URL::previous();
    }

    /**
     * Confirm that the user would like to delete their account.
     *
     * @return void
     */
    public function confirmDeletion()
    {
        $this->confirm('Delete item', [
            'position' =>  'center',
            'timer' =>  10000,
            'toast' =>  false,
            'text' =>  'Are you sure you want to delete this item? Once it is deleted, all of its resources and data will be permanently deleted.',
            'confirmButtonText' =>  'Delete',
            'cancelButtonText' =>  'Cancel',
            'showCancelButton' =>  true,
            'showConfirmButton' =>  true,
            'onConfirmed' => 'deleteConfirmed',
            'onCancelled' => 'deleteCancelled',
        ]);

        $this->resetErrorBag();
    }

    public function getListeners()
    {
        return array_merge($this->listeners, ['deleteConfirmed', 'deleteCancelled']);
    }

    public function deleteConfirmed()
    {
        try {
            if (method_exists($this, 'deleteModel')) {
                $this->deleteModel();
            } else {
                $this->getDeleteModel()->delete();
            }
        } catch (Throwable $exception) {
            $this->exceptionAlert($exception);

            return;
        }

        if ($this instanceof Datatable) {
            $this->alert('success', 'Item deleted', [
                'position' =>  'top-end',
                'timer' =>  3000,
                'toast' =>  true,
                'text' =>  'Item successfully deleted.',
            ]);
            $this->emit('refreshLivewireDatatable');
        } else {
            $this->flash('success', 'Item deleted', [
                'position' =>  'top-end',
                'timer' =>  3000,
                'toast' =>  true,
                'text' =>  'Item successfully deleted.',
            ]);
            $this->redirect($this->previous);
        }
    }

    public function deleteCancelled()
    {
        if (method_exists($this, 'resetDeleteModel')) {
            $this->resetDeleteModel();
        }
    }
}
