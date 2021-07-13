<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use App\View\Components\Client\ClientList;
use App\View\Components\Client\ClientWizard;
use App\View\Components\Factor\FactorDetails;
use Illuminate\Support\Facades\Route;

Route::prefix('clients')->name('clients.')->group(function () {
    Route::get('', ClientList::class)->name('list');
    Route::get('/create', ClientWizard::class)->name('create');
    Route::get('{client_id}', FactorDetails::class)->name('view');
    Route::get('{client_id}/update', ClientWizard::class)->name('update');
});
