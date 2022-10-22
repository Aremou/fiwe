<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterestCenterMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interest_center_medias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('interest_center_id');
            $table->foreign('interest_center_id')
                ->references('id')
                ->on('interest_centers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('medias_id');
            $table->foreign('medias_id')
                ->references('id')
                ->on('medias')
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
        Schema::dropIfExists('interest_center_media');
    }
}
