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

class CreateTermFeeRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('term_fee_rules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('term_id')->constrained('terms');
            $table->double('advance_rate');
            $table->double('purchase_fee_rate');
            $table->double('escrow_rate');
            $table->double('minimum_fee_per_invoice')->nullable();
            $table->boolean('minimum_fee_applied_to_non_advanced_loads');
            $table->enumValue('collection_fee_rule'); // CollectionFeeRule
            $table->enumValue('escrow_rebate_rule'); // EscrowRebateRule
            $table->enumValue('fee_base_date'); // BaseDateType
            $table->enumValue('first_day_date'); // BaseDateType
            $table->enumValue('rate_base_type'); // RateBaseType, rate percentage of
            $table->boolean('prioritize_minimum_fee');
            $table->enumValue('float_days_type'); // FloatDaysType
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
        Schema::dropIfExists('term_fee_rules');
    }
}
