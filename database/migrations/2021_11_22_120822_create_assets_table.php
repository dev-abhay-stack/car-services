<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('thumbnail')->nullable();
            $table->integer('location_id')->default(0);
            $table->text('parts_id')->nullable();
            $table->text('pms_id')->nullable();
            $table->text('vendor_id')->nullable();
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
        Schema::dropIfExists('assets');
    }
}
