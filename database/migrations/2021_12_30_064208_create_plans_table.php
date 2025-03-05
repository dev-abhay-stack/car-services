<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name',100)->unique();
            $table->float('monthly_price')->default(0);
            $table->float('annual_price')->default(0);
            $table->integer('trial_days')->default(0);
            $table->string('duration')->nullable();
            $table->integer('max_locations')->default(0);
            $table->integer('max_users')->default(0);
            $table->integer('max_wo')->default(0);
            $table->text('description')->nullable();
            $table->string('image');
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('plans');
    }
}
