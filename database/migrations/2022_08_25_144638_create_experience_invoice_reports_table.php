<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperienceInvoiceReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experience_invoice_reports', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->foreignId('account_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->string('status');
            $table->boolean('is_resolved');
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
        Schema::dropIfExists('experience_invoice_reports');
    }
}
