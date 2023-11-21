<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvincePrevesionnelle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paroisse_prevesionnelle', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('activite_previsionnelle_id');
            $table->foreign('activite_previsionnelle_id')->references('id')->on('activite_previsionnelles')->onDelete('cascade');
            $table->unsignedBigInteger('paroisse_id');
            $table->foreign('paroisse_id')->references('id')->on('paroisses')->onDelete('cascade');
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
        Schema::dropIfExists('paroisse_prevesionnelle');
    }
}
