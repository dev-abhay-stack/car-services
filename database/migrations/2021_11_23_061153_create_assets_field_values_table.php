<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsFieldValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets_field_values', function (Blueprint $table) {
            $table->id();
            $table->integer('record_id');
            $table->integer('field_id');
            $table->text('value');
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
        Schema::dropIfExists('assets_field_values');
    }
}
