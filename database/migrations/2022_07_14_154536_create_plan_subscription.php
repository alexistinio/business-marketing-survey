<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dim_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->nullable();
            $table->string('text')->nullable();
            $table->double('price')->default(0);
            $table->integer('duration_month')->nullable();
            $table->unsignedBigInteger('status_id')->default(1);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('status_id')->references('id')->on('dim_status');
        });

        Schema::create('dim_subscription_status', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->nullable();
            $table->string('text')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });

        Schema::create('fct_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('plan_id');
            $table->dateTime('start_timestamp')->nullable();
            $table->dateTime('end_timestamp')->nullable();
            $table->dateTime('purchase_timestamp')->nullable();
            $table->unsignedBigInteger('status_id');

            $table->foreign('plan_id')->references('id')->on('dim_plans');
            $table->foreign('status_id')->references('id')->on('dim_subscription_status');
            $table->foreign('user_id')->references('id')->on('dim_users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dim_plans');
        Schema::dropIfExists('fct_subscription');
    }
};
