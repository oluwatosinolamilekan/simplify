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

class AddMissingCommonAttributesToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contact_details', function (Blueprint $table) {
            $table->json('meta')->nullable();
            $table->blameable();
        });

        Schema::table('addresses', function (Blueprint $table) {
            $table->json('meta')->nullable();
            $table->blameable();
        });

        Schema::table('bank_information', function (Blueprint $table) {
            $table->json('meta')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contact_details', function (Blueprint $table) {
            $table->removeColumn('meta');
            $table->dropConstrainedForeignId('created_by');
            $table->dropConstrainedForeignId('updated_by');
        });

        Schema::table('addresses', function (Blueprint $table) {
            $table->removeColumn('meta');
            $table->dropConstrainedForeignId('created_by');
            $table->dropConstrainedForeignId('updated_by');
        });

        Schema::table('bank_information', function (Blueprint $table) {
            $table->removeColumn('meta');
        });
    }
}
