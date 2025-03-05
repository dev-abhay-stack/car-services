<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWosCommentImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wos_comment_images', function (Blueprint $table) {
            $table->id();
            $table->integer('woc_id')->nullable();
            $table->string('file')->nullable();
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
        Schema::dropIfExists('wos_comment_images');
    }
}
