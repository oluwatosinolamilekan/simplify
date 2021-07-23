<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use App\View\Components\Vendor\VendorDetails;
use App\View\Components\Vendor\VendorList;
use App\View\Components\Vendor\VendorWizard;
use Illuminate\Support\Facades\Route;

Route::prefix('vendors')->name('vendors.')->group(function () {
    Route::get('', VendorList::class)->name('list');
    Route::get('/create', VendorWizard::class)->name('create');
    Route::get('{vendor_id}', VendorDetails::class)->name('view');
    Route::get('{vendor_id}/update', VendorWizard::class)->name('update');
});
