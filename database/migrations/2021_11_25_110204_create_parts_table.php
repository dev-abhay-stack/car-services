<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parts', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('thumbnail')->nullable();
            $table->text('number')->nullable();
            $table->decimal('quantity')->default(0);
            $table->float('price')->default(0);
            $table->text('category')->nullable();
            $table->text('vendor_id')->nullable();
            $table->text('assets_id')->nullable();
            $table->text('wo_id')->nullable();
            $table->integer('location_id')->default(0);
            $table->integer('created_by')->default(0);
            $table->integer('company_id')->default(0);
            $table->tinyinteger('is_active')->default(1);
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
        Schema::dropIfExists('parts');
    }
}
