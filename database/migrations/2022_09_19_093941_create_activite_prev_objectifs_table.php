<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitePrevObjectifsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activite_prev_objectifs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('activite_prev_id');
            $table->unsignedBigInteger('objectif_specifique_id');
            $table->foreign('objectif_specifique_id')->references('id')->on('objectif_specifiques')->onDelete('cascade');
            $table->foreign('activite_prev_id')->references('id')->on('activite_previsionnelles')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('activite_prev_objectifs');
    }
}
