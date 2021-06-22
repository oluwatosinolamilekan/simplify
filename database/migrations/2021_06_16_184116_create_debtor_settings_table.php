<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDebtorSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debtor_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('debtor_id')->constrained('debtors');
            $table->boolean('buy_status')->default(1);
            $table->boolean('do_not_contact')->default(0);
            $table->string('noa_email', 255);
            $table->boolean('require_original_invoices')->default(0);
            $table->json('warning_notes');
            $table->common();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('debtor_settings');
    }
}
