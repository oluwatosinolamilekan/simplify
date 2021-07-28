<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use App\View\Components\Term\TermsList;
use App\View\Components\Term\TermWizard;
use App\View\Components\User\UserDetails;
use Illuminate\Support\Facades\Route;

Route::prefix('terms')->as('terms.')->group(function () {
    Route::get('', TermsList::class)->name('list');
    Route::get('create', TermWizard::class)->name('create');
    Route::get('{term_id}', UserDetails::class)->name('view');
    Route::get('{term_id}/update', TermWizard::class)->name('update');
});
