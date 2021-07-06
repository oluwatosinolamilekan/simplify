<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use App\View\Components\Factor\FactorDetails;
use App\View\Components\Factor\FactorsList;
use App\View\Components\Factor\FactorWizard;
use Illuminate\Support\Facades\Route;

Route::prefix('factors')->name('factors.')->group(function () {
    Route::get('', FactorsList::class)->name('list');
    Route::get('/create', FactorWizard::class)->name('create');
    Route::get('{factor_id}', FactorDetails::class)->name('view');
    Route::get('{factor_id}/update', FactorWizard::class)->name('update');
});
