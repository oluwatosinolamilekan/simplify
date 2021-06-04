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

Route::get('/users', ListUsers::class)->name('user.list');
