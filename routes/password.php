<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use App\Http\Controllers\PasswordController;
use Laravel\Fortify\Features;

Route::group(['middleware' => config('fortify.middleware', ['web'])], function () {
    Route::get('/configure/{token}', [PasswordController::class, 'configure'])
        ->middleware(['guest:'.config('fortify.guard')])
        ->name('password.configure');

    Route::post('/configure/{token}', [PasswordController::class, 'store'])
        ->middleware(['guest:'.config('fortify.guard')])
        ->name('password.configure');

    if (Features::enabled(Features::resetPasswords())) {
        Route::get('/reset-password/{token}', [PasswordController::class, 'create'])
            ->middleware(['guest:'.config('fortify.guard')])
            ->name('password.reset');

        Route::post('/reset-password', [PasswordController::class, 'store'])
            ->middleware(['guest:'.config('fortify.guard')])
            ->name('password.update');
    }
});
