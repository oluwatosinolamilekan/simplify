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

Route::prefix('users')->as('users.')->group(function () {
    Route::get('', UsersList::class)->name('list');
    Route::get('create', UserForm::class)->name('create');
    Route::get('{user_id}', UserDetails::class)->name('view');
    Route::get('{user_id}/update', UserForm::class)->name('update');
});
