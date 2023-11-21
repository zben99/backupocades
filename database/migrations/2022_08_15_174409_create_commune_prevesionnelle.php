<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunePrevesionnelle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commune_prevesionnelle', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('activite_previsionnelle_id');
            $table->foreign('activite_previsionnelle_id')->references('id')->on('activite_previsionnelles')->onDelete('cascade');
            $table->unsignedBigInteger('commune_id');
            $table->foreign('commune_id')->references('id')->on('communes')->onDelete('cascade');
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
        Schema::dropIfExists('commune_prevesionnelle');
    }
}
