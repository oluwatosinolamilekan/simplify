<?php

declare(strict_types=1);

/*
 * This file is part of the 2amigos/addio
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use App\Enums\InvoiceDocumentType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained('invoices');
            $table->string('name', 255);
            $table->enumValue('type', InvoiceDocumentType::Other);
            $table->string('path', 1025);
            $table->integer('size');
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
        Schema::dropIfExists('invoice_documents');
    }
}
