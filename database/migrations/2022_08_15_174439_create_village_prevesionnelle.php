<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVillagePrevesionnelle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('village_prevesionnelle', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('activite_previsionnelle_id');
            $table->foreign('activite_previsionnelle_id')->references('id')->on('activite_previsionnelles')->onDelete('cascade');
            $table->unsignedBigInteger('village_id');
            $table->foreign('village_id')->references('id')->on('villages')->onDelete('cascade');
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
        Schema::dropIfExists('village_prevesionnelle');
    }
}
