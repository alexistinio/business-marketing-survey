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
        Schema::create('dim_menus', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('text');
            $table->unsignedBigInteger('status_id')->default(1);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('status_id')->references('id')->on('dim_status');
        });

        Schema::create('fct_menu_permission', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_id');
            $table->string('permission');
            $table->string('name')->unique();
            $table->string('text');
            $table->unsignedBigInteger('status_id')->default(1);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('status_id')->references('id')->on('dim_status');
            $table->foreign('menu_id')->references('id')->on('dim_menus');
        });

        Schema::create('fct_menu_role_permission', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('permission_id');
            $table->unsignedBigInteger('status_id')->default(1);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('status_id')->references('id')->on('dim_status');
            $table->foreign('role_id')->references('id')->on('dim_roles');
            $table->foreign('permission_id')->references('id')->on('fct_menu_permission');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dim_menus');
        Schema::dropIfExists('fct_menu_permission');
        Schema::dropIfExists('fct_menu_role_permission');
    }
};
