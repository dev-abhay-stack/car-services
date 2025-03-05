<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePmsInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pms_invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('pms_id')->nullable();
            $table->string('invoice_cost')->nullable();
            $table->text('description')->nullable();
            $table->string('invoice_file')->nullable();
            $table->integer('location_id')->default(0);
            $table->integer('created_by')->default(0);
            $table->integer('company_id')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pms_invoices');
    }
}
