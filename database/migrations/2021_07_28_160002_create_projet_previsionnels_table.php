<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjetprevisionnelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projet_previsionnels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom');
            $table->date('debut');
            $table->date('fin');
            $table->text('objectSpecifique')->nullable();
            $table->text('objectGeneral')->nullable();
            $table->text('resultatAttendu')->nullable();
            $table->decimal('montant', 20, 2)->default(0);
            $table->unsignedBigInteger('program_id');
            $table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade');
            $table->unsignedBigInteger('agent');
            $table->foreign('agent')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projet_previsionnels');
    }
}
