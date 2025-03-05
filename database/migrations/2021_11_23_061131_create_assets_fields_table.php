<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets_fields', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->string('module');
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
        Schema::dropIfExists('assets_fields');
    }
}
