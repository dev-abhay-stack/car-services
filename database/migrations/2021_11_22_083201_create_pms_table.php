<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pms', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->integer('location_id');
            $table->text('description')->nullable();
            $table->text('parts_id')->nullable();
            $table->string('tags')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('company_id')->nullable();
            $table->integer('is_active')->nullable();
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
        Schema::dropIfExists('pms');
    }
}
