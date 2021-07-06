<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use App\View\Components\User\UserDetails;
use App\View\Components\User\UserForm;
use App\View\Components\User\UsersList;
use Illuminate\Support\Facades\Route;

Route::prefix('users')->group(function () {
    Route::get('', UsersList::class)->name('users.list');
    Route::get('/create', UserForm::class)->name('users.create');
    Route::get('{id}', UserDetails::class)->name('users.view');
    Route::get('{id}/update', UserForm::class)->name('users.update');
});
