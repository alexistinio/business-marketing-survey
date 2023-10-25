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
        Schema::create('dim_status', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('text')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });

        Schema::create('dim_roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('text')->nullable();
            $table->unsignedBigInteger('status_id')->default(1);
            $table->dateTime('deleted_at')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('status_id')->references('id')->on('dim_status');
        });

        Schema::create('dim_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id');
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->string('voucher')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->unsignedBigInteger('status_id')->default(1);
            $table->dateTime('deleted_at')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('role_id')->references('id')->on('dim_roles');
            $table->foreign('status_id')->references('id')->on('dim_status');
           
            
        });

        Schema::create('fct_user_details', function (Blueprint $table) {
            $table->id()->startingValue(2);
            $table->unsignedBigInteger('user_id')->unique();
            $table->string('gender')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('phone_no')->nullable();
            $table->longText('about_me')->nullable();
            $table->longText('profile')->nullable();
            $table->longText('background_image')->nullable();
            $table->longText('website_link')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

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
        Schema::dropIfExists('dim_status');
        Schema::dropIfExists('dim_roles');
        Schema::dropIfExists('dim_users');
    }
};
