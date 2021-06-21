<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\Providers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\ServiceProvider;

class BlueprintMacroServiceProvider extends ServiceProvider
{
    /**
     * Register blueprint macros.
     *
     * @return void
     */
    public function boot(): void
    {
        Blueprint::macro('blameable', function () {
            $this->foreignId('created_by')->constrained('users');
            $this->foreignId('updated_by')->nullable()->constrained('users');
        });

        Blueprint::macro('timestamps', function () {
            $this->timestamp('created_at')->useCurrent();
            $this->timestamp('updated_at')->nullable();
        });

        Blueprint::macro('common', function () {
            $this->json('meta')->nullable();
            $this->blameable();
            $this->timestamps();
        });

        Blueprint::macro('enumValue', function (string $name, int $default = null) {
            return $this->tinyInteger($name)->default($default);
        });

        Blueprint::macro('status', function (int $default = null) {
            return $this->enumValue('status', $default);
        });

        Blueprint::macro('code', function (string $name = 'code') {
            return $this->string($name, 125);
        });

        Blueprint::macro('boolean', function (string $name, int $default = null) {
            return $this->tinyInteger($name)->default($default);
        });
    }
}
