<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use App\Enums\CreditRatingType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDebtorCreditRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debtor_credit_ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('debtor_id')->constrained('debtors');
            $table->foreignId('debtor_credit_id')->constrained('debtor_credits');
            $table->string('rating', 1025);
            $table->string('limit', 1025)->nullable();
            $table->string('data')->nullable();
            $table->enumValue('type', CreditRatingType::Other)->nullable();
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
        Schema::dropIfExists('debtor_credit_ratings');
    }
}
