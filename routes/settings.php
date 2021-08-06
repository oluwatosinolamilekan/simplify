<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use App\View\Components\Settings\SettingsForm;
use Illuminate\Support\Facades\Route;

Route::prefix('settings')->as('settings.')->group(function () {
    Route::get('', SettingsForm::class)->name('update');
});
