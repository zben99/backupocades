<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activites', function (Blueprint $table) {
            $table->id();
            $table->string('libelle')->nullable();
            $table->date('date_realisation');
            $table->integer('unite_physique');
            $table->boolean('validate')->default(0);
            $table->integer('quantite_realise')->nullable();
            $table->double('cout_total_realisation');
            $table->double('contrib_beneficiaire')->nullable();
            $table->integer('bene_d_homme')->nullable();
            $table->integer('bene_d_femme')->nullable();
            $table->unsignedBigInteger('activite_previsionnelle_id');
            $table->foreign('activite_previsionnelle_id')->references('id')->on('activite_previsionnelles')->onDelete('cascade');
            $table->unsignedBigInteger('paroisse_id');
            $table->foreign('paroisse_id')->references('id')->on('paroisses')->onDelete('cascade');
            $table->unsignedBigInteger('domaine_id');
            $table->foreign('domaine_id')->references('id')->on('domaines')->onDelete('cascade');
            $table->unsignedBigInteger('agent');
            $table->foreign('agent')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('activites');
    }
}
