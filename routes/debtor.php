<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use App\View\Components\Debtor\DebtorDetails;
use App\View\Components\Debtor\DebtorsList;
use App\View\Components\Debtor\DebtorWizard;
use Illuminate\Support\Facades\Route;

Route::prefix('debtors')->name('debtors.')->group(function () {
    Route::get('', DebtorsList::class)->name('list');
    Route::get('/create', DebtorWizard::class)->name('create');
    Route::get('{debtor_id}', DebtorDetails::class)->name('view');
    Route::get('{debtor_id}/update', DebtorWizard::class)->name('update');
});
