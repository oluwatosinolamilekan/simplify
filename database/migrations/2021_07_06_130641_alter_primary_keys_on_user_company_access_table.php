<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use App\Enums\Status;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPrimaryKeysOnUserCompanyAccessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('user_company_access');

        Schema::create('user_company_access', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('company_id')->constrained('companies');

            $table->unique(['user_id', 'company_id']);

            $table->tinyInteger('status')->default(Status::Active);
            $table->tinyInteger('role');
            $table->json('permissions')->nullable();

            $table->string('first_name', 255)->nullable();
            $table->string('last_name', 255)->nullable();
            $table->string('middle_name', 255)->nullable();
            $table->json('emails')->nullable();
            $table->json('phone_numbers')->nullable();

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
        Schema::dropIfExists('user_company_access');

        Schema::create('user_company_access', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('company_id')->constrained('companies');

            $table->primary(['user_id', 'company_id']);

            $table->tinyInteger('status')->default(Status::Active);
            $table->tinyInteger('role');
            $table->json('permissions')->nullable();
            $table->string('first_name', 255)->nullable();
            $table->string('last_name', 255)->nullable();
            $table->string('middle_name', 255)->nullable();
            $table->json('emails')->nullable();
            $table->json('phone_numbers')->nullable();

            $table->common();
        });
    }
}
