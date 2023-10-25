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
        Schema::create('fct_user_following', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('following_id');
            $table->unsignedBigInteger('status_id')->default(1);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('status_id')->references('id')->on('dim_status');
            $table->foreign('user_id')->references('id')->on('dim_users');
            $table->foreign('following_id')->references('id')->on('dim_users');
        });

        Schema::create('fct_user_group', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('status_id')->default(1);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('status_id')->references('id')->on('dim_status');
            $table->foreign('user_id')->references('id')->on('dim_users');
            $table->foreign('group_id')->references('id')->on('dim_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fct_user_following');
        Schema::dropIfExists('fct_user_group');
    }
};
