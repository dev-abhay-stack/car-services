<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePmsLogTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pms_log_times', function (Blueprint $table) {
            $table->id();
            $table->integer('pms_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('hours')->nullable();
            $table->string('minute')->nullable();
            $table->date('date')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('pms_log_times');
    }
}
