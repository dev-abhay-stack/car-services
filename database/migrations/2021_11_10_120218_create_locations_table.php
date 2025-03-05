<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('address');
            $table->integer('created_by')->default(0);
            $table->integer('company_id')->default(0);
            $table->string('lang',5)->default('en');
            $table->integer('interval_time')->default(10);
            $table->string('currency')->default('$');
            $table->string('currency_code')->nullable();
            $table->string('company')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('country')->nullable();
            $table->string('telephone')->nullable();
            $table->string('logo')->nullable();
            $table->integer('is_stripe_enabled')->default(0);
            $table->text('stripe_key')->nullable();
            $table->text('stripe_secret')->nullable();
            $table->integer('is_paypal_enabled')->default(0);
            $table->text('paypal_mode')->nullable();
            $table->text('paypal_client_id')->nullable();
            $table->text('paypal_secret_key')->nullable();
            $table->string('invoice_template')->nullable();
            $table->string('invoice_color')->nullable();
            $table->text('invoice_footer_title')->nullable();
            $table->text('invoice_footer_notes')->nullable();
            $table->integer('is_active')->default(1)->comment('1 => active || 0 => deactive');;
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
        Schema::dropIfExists('locations');
    }
}
