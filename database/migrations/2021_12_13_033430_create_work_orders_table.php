<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('assets_id')->nullable();
            $table->text('parts_id')->nullable();
            $table->text('wo_name')->nullable();
            $table->text('instructions')->nullable();
            $table->text('tags')->nullable();
            $table->string('priority')->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->string('sand_to')->nullable();
            $table->integer('location_id')->default(0);
            $table->integer('created_by')->default(0);
            $table->integer('company_id')->default(0);
            $table->string('hours')->nullable();
            $table->string('minute')->nullable();
            $table->integer('status')->default(1)->comment('1 => open, 2 => complete');
            $table->string('work_status')->nullable();
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
        Schema::dropIfExists('work_orders');
    }
}
