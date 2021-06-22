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

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('factor_id')->constrained('factors');
            $table->foreignId('client_id')->constrained('clients');
            $table->foreignId('debtor_id')->constrained('debtors');
            $table->foreignId('vendor_id')->constrained('vendors');
            $table->code('invoice_number');
            $table->code('reference_number');
            $table->unique(['client_id', 'invoice_number']);
            $table->date('date');
            $table->date('due_date');
            $table->double('amount');
            $table->double('advance_rate');
            $table->double('advance_amount');
            $table->date('purchase_date');
            $table->date('payment_date')->nullable();
            $table->status(Status::Requested);
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
        Schema::dropIfExists('invoices');
    }
}
