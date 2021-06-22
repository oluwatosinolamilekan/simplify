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

class CreateClientFundingInstructionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_funding_instructions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients');
            $table->boolean('generate_invoice')->default(1);
            $table->boolean('send_invoice')->default(1);
            $table->boolean('efs_available')->default(0);
            $table->double('fuel_advance_fee')->nullable();
            $table->double('fuel_advance_max_rate')->nullable();
            $table->double('funding_limit')->nullable();
            $table->json('notes')->nullable();
            $table->double('max_invoice_amount')->nullable();
            $table->boolean('outsource_collections')->default(0);
            $table->boolean('allow_fundings')->default(1);
            $table->boolean('allow_reserve_release')->default(1);
            $table->boolean('send_email_remittances')->default(1);
            $table->string('schedule_submission_email', 255);
            $table->json('warning_notes')->nullable();
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
        Schema::dropIfExists('client_funding_instructions');
    }
}
