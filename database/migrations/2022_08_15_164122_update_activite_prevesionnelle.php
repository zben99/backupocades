<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateActivitePrevesionnelle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activite_previsionnelles', function (Blueprint $table) {
            $table->date('date_realisation')->nullable();
            $table->integer('bene_d_homme')->nullable();
            $table->integer('bene_d_femme')->nullable();
            $table->unsignedBigInteger('region_id')->nullable();
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');
            $table->unsignedBigInteger('domaine_id')->nullable();
            $table->foreign('domaine_id')->references('id')->on('domaines')->onDelete('cascade');
            $table->string('observation')->nullable();
            $table->string('unite_physique')->nullable();
            $table->string('contrib_beneficiaire')->nullable();
            $table->string('type_beneficiaire')->nullable();
            
        });    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
