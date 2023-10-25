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
        Schema::create('fct_message_chat_room', function (Blueprint $table) {
            $table->id();
            $table->string('user_ids')->nullable();
            $table->string('chat_id')->unique();
            $table->unsignedBigInteger('status_id')->default(1);
            $table->timestamps();

            $table->foreign('status_id')->references('id')->on('dim_status');
        });

        Schema::table('fct_messages', function(Blueprint $table){
            $table->renameColumn('user_id', 'user_id_from');
            $table->unsignedBigInteger('chat_room_id')->nullable();
            $table->integer('user_id_to')->after('user_id');
            $table->dateTime('read_at')->nullable()->after('updated_at');

            $table->foreign('chat_room_id')->references('id')->on('fct_message_chat_room');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
