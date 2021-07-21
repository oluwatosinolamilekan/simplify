<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\View\Components\Traits;

use Throwable;

trait WithAlerts
{
    /**
     * Display alert for given exception.
     *
     * @param Throwable $exception
     * @return void
     */
    public function exceptionAlert(Throwable $exception)
    {
        $this->alert('error', 'Something went wrong', [
            'position' =>  'top-end',
            'timer' =>  5000,
            'toast' =>  true,
            'text' =>  $exception->getMessage(),
            'showCancelButton' =>  false,
            'showConfirmButton' =>  false,
        ]);
    }

    /**
     * Display alert for given exception.
     *
     * @param string|null $message
     * @return void
     */
    public function successAlert(?string $message = null)
    {
        $this->alert('success', $message ?? 'Done.', [
            'position' =>  'top-end',
            'timer' =>  5000,
            'toast' =>  true,
            'showCancelButton' =>  false,
            'showConfirmButton' =>  false,
        ]);
    }
}
