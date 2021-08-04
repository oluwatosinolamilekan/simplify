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

class AlterForeignKeysOnFeeRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fee_rules', function (Blueprint $table) {
            $table->dropConstrainedForeignId('term_fee_rules_id');
            $table->foreignId('term_id')->constrained('terms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fee_rules', function (Blueprint $table) {
            $table->dropConstrainedForeignId('term_id');
            $table->foreignId('term_fee_rules_id')->constrained('term_fee_rules');
        });
    }
}
