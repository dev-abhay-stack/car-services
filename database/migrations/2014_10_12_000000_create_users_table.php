<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('user_type')->comments('super admin,company,employee,client')->nullable();
            $table->string('created_by')->default(0);
            $table->integer('company_id')->default(0);
            $table->text('avatar')->nullable();
            $table->string('lang')->default('en');

            $table->integer('plan')->nullable();
            $table->string('plan_type')->nullable();
            $table->integer('requested_plan')->default(0);
            $table->date('plan_expire_date')->nullable();
            $table->string('payment_subscription_id')->nullable();
            $table->integer('is_trial_done')->default(0);
            $table->integer('is_plan_purchased')->default(0);
            $table->integer('interested_plan_id')->default(0);
            $table->integer('is_register_trial')->default(0);
            
            $table->integer('is_deleted')->comments('0 => not deleted, 1 => deleted')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
