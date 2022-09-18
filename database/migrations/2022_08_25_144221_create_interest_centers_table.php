<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterestCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interest_centers', function (Blueprint $table) {
            $table->id();
            $table->json('label');
            $table->json('description');
            $table->integer('latitude');
            $table->integer('longitude');
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('interest_center_category_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->integer('picture')->nullable();
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
        Schema::dropIfExists('interest_centers');
    }
}
