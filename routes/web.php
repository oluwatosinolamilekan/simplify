<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/** Authenticated */
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    require base_path('routes/dashboard.php');
    require base_path('routes/user.php');
    require base_path('routes/factor.php');
    require base_path('routes/client.php');
    require base_path('routes/company.php');
});

/** Public routes */
require base_path('routes/password.php');
