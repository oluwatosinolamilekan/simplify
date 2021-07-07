<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use App\View\Components\Company\User\CompanyUserDetails;
use App\View\Components\Company\User\CompanyUserForm;
use App\View\Components\Company\User\CompanyUsersList;
use Illuminate\Support\Facades\Route;

Route::prefix('companies')->name('companies.')->group(function () {

        // Users
    Route::prefix('{company_id}/users')->as('users.')->group(function () {
        Route::get('', CompanyUsersList::class)->name('list');
        Route::get('create', CompanyUserForm::class)->name('create');
        Route::get('{user_id}', CompanyUserDetails::class)->name('view');
        Route::get('update/{user_id}', CompanyUserForm::class)->name('update');
    });
});
