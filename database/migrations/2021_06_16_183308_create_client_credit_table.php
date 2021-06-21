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

class CreateClientCreditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_credit', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients');
            $table->boolean('approved')->default(0);
            $table->string('credit_rating', 255);
            $table->double('credit_limit');
            $table->double('debtor_limit');
            $table->double('debtor_concentration');
            $table->integer('standard_terms')->default(30);
            $table->integer('ineligible_days')->default(0);
            $table->boolean('report_charge')->default(0);
            $table->double('report_charge_amount')->default(0);
            $table->date('ucc_date');
            $table->date('ucc_date_2');
            $table->date('ucc_expiring_date');
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
        Schema::dropIfExists('client_credit');
    }
}
