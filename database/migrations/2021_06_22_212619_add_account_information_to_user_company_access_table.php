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

class AddAccountInformationToUserCompanyAccessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_company_access', function (Blueprint $table) {
            $table->string('first_name', 255)->nullable();
            $table->string('last_name', 255)->nullable();
            $table->string('middle_name', 255)->nullable();
            $table->json('emails')->nullable();
            $table->json('phone_numbers')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_company_access', function (Blueprint $table) {
            $table->removeColumn('first_name');
            $table->removeColumn('last_name');
            $table->removeColumn('middle_name');
            $table->removeColumn('emails');
            $table->removeColumn('phone_numbers');
        });
    }
}
