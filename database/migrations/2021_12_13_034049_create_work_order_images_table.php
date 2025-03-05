<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkOrderImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_order_images', function (Blueprint $table) {
            $table->id();
            $table->integer('wo_id')->nullable();
            $table->text('image')->nullable();
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
        Schema::dropIfExists('work_order_images');
    }
}
