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
        Schema::create('dim_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->longText('image')->nullable();
            $table->unsignedBigInteger('status_id')->default(1);
            $table->date('deleted_at')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('status_id')->references('id')->on('dim_status');
        });

        Schema::create('fct_survey_category_post', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('survey_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('status_id')->default(1);
            $table->date('deleted_at')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('status_id')->references('id')->on('dim_status');
            $table->foreign('survey_id')->references('id')->on('dim_surveys');
            $table->foreign('category_id')->references('id')->on('dim_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dim_categories');
        Schema::dropIfExists('fct_survey_category_post');
    }
};
