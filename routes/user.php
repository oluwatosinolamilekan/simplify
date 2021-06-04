<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use App\View\Components\User\ListUsers;
use Illuminate\Support\Facades\Route;

Route::prefix('users')->group(function () {
    Route::get('', ListUsers::class)->name('users.list');
    Route::get('{id}', ListUsers::class)->name('users.view');
    Route::get('{id}/update', ListUsers::class)->name('users.update');
    Route::get('{id}/delete', ListUsers::class)->name('users.delete');
});
