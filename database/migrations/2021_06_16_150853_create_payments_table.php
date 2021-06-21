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

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('factor_id')->constrained('factors');
            $table->foreignId('client_id')->constrained('clients');
            $table->date('date');
            $table->status(Status::Draft);
            $table->double('amount');
            $table->enumValue('method');
            $table->double('fee');
            $table->code('transaction_reference');
            $table->string('remitter', 255); // TODO: reconcile this
            $table->string('memo', 1025)->nullable();
            $table->json('notes')->nullable();

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
        Schema::dropIfExists('payments');
    }
}
