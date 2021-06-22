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

class CreateDebtorCreditLimitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debtor_credit_limits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('debtor_id')->constrained('debtors');
            $table->double('all_customer_limit');
            $table->date('credit_date');
            $table->date('credit_expiry_date');
            $table->integer('months_good_for');
            $table->json('notes');
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
        Schema::dropIfExists('debtor_credit_limits');
    }
}
