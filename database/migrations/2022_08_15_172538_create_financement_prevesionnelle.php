<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancementPrevesionnelle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financement_prevesionnelle', function (Blueprint $table) {
            $table->id();
            $table->double('montant');
            $table->string('description')->nullable();
            $table->unsignedBigInteger('activite_previsionnelle_id');
            $table->foreign('activite_previsionnelle_id')->references('id')->on('activite_previsionnelles')->onDelete('cascade');
            $table->unsignedBigInteger('partenaire_id');
            $table->foreign('partenaire_id')->references('id')->on('partenaires')->onDelete('cascade');
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
        Schema::dropIfExists('financement_prevesionnelle');
    }
}
