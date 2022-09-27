<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTouristExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tourist_experiences', function (Blueprint $table) {
            $table->id();
            $table->json('label');
            $table->json('description');
            $table->string('city');
            $table->decimal('unit_price');
            $table->integer('image_id');
            $table->integer('video_id');
            $table->integer('geolocation_id');
            $table->boolean('is_active');
            $table->softDeletes();
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
        Schema::dropIfExists('tourist_experiences');
    }
}
