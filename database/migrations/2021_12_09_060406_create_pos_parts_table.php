<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosPartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos_parts', function (Blueprint $table) {

            $table->id();
            $table->text('pos_id')->nullable();
            $table->integer('parts_id')->nullable();
            $table->text('quantity')->nullable();
            $table->text('tax')->nullable();
            $table->text('discount')->nullable();
            $table->text('price')->nullable();
            $table->text('shipping')->nullable();
            $table->text('description')->nullable();
            $table->integer('location_id')->default(0);
            $table->integer('created_by')->default(0);
            $table->integer('company_id')->default(0);
            $table->integer('is_active')->default(1);
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
        Schema::dropIfExists('pos_parts');
    }
}
