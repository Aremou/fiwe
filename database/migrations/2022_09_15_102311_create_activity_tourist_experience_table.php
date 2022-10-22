<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityTouristExperienceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_tourist_experience', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('activity_id');
            $table->foreign('activity_id')
                ->references('id')
                ->on('activities')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('tourist_experience_id');
            $table->foreign('tourist_experience_id')
                ->references('id')
                ->on('tourist_experiences')
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
        Schema::dropIfExists('activity_tourist_experience');
    }
}
