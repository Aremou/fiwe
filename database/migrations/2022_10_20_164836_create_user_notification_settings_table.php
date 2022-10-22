<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserNotificationSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_notification_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('new_post')->default(1);
            $table->boolean('like_mention')->default(1);
            $table->boolean('comments')->default(1);
            $table->boolean('discussions_answers')->default(1);
            $table->integer('program_reminder')->default(1);
            $table->boolean('new_tourist_experience')->default(0);
            $table->boolean('nearby_players')->default(0);
            $table->boolean('share_experiences')->default(0);
            $table->integer('repeat_unread_notifications')->default(1);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('user_notification_settings');
    }
}
