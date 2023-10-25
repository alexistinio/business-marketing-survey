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
        Schema::create('dim_question_type', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('text')->nullable();
            $table->unsignedBigInteger('status_id')->default(1);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('status_id')->references('id')->on('dim_status');
        });

        Schema::create('dim_surveys', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('status_id')->default(1);
            $table->string('title');
            $table->longText('description')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('is_private')->nullable();
            $table->date('deleted_at')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('status_id')->references('id')->on('dim_status');
            $table->foreign('user_id')->references('id')->on('dim_users');
        });

        Schema::create('fct_survey_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('survey_id');
            $table->unsignedBigInteger('status_id')->default(1);
            $table->unsignedBigInteger('question_type_id');
            $table->string('question')->nullable();
            $table->date('deleted_at')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('status_id')->references('id')->on('dim_status');
            $table->foreign('survey_id')->references('id')->on('dim_surveys');
            $table->foreign('question_type_id')->references('id')->on('dim_question_type');
        });

        Schema::create('fct_survey_choices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('survey_question_id');
            $table->unsignedBigInteger('status_id')->default(1);
            $table->string('choice')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('status_id')->references('id')->on('dim_status');
            $table->foreign('survey_question_id')->references('id')->on('fct_survey_questions');
        });

        Schema::create('fct_survey_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('survey_id');
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('choice_id');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('survey_id')->references('id')->on('dim_surveys');
            $table->foreign('user_id')->references('id')->on('dim_users');
            $table->foreign('question_id')->references('id')->on('fct_survey_questions');
            $table->foreign('choice_id')->references('id')->on('fct_survey_choices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dim_surveys');
        Schema::dropIfExists('fct_survey_questions');
        Schema::dropIfExists('fct_survey_choices');
        Schema::dropIfExists('fct_survey_answers');
    }
};
