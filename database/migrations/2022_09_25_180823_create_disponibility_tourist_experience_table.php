<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisponibilityTouristExperienceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disponibility_tourist_experience', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('disponibility_id');
            $table->foreign('disponibility_id')
                ->references('id')
                ->on('disponibilities')
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
        Schema::dropIfExists('disponibility_tourist_experience');
    }
}
