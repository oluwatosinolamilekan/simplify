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

class AlterClientCompanyFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_identities', function (Blueprint $table) {
            $table->string('alternate_name', 255)->nullable()->change();
            $table->code('fed_tax_id')->nullable()->change();
            $table->code('duns_id')->nullable()->change();
            $table->code('edi_id')->nullable()->change();
        });

        Schema::table('clients', function (Blueprint $table) {
            $table->string('office', 255)->nullable()->after('ref_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_identities', function (Blueprint $table) {
            $table->string('alternate_name', 255)->change();
            $table->code('fed_tax_id')->change();
            $table->code('duns_id')->change();
            $table->code('edi_id')->change();
        });

        Schema::table('clients', function (Blueprint $table) {
            $table->removeColumn('office');
        });
    }
}
