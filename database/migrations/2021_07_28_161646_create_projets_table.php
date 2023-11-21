<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('libelle');
            $table->text('description');
            $table->decimal('budget', 20, 2)->nullable();
            $table->decimal('montantCharge', 20, 2)->nullable();
            $table->decimal('montantEquipement', 20, 2)->nullable();
            $table->decimal('totalRessFinanciere', 20, 2)->nullable();
            $table->string('chefProjet');
            $table->date('debut');
            $table->date('fin');
            $table->decimal('depenseBeneficiaire', 20, 2)->nullable();
            $table->decimal('montantTotalDepense', 20, 2)->nullable();
            $table->foreignId('document_id');
            $table->foreignId('projetprevisionnel_id');
            $table->unsignedBigInteger('agent');
            $table->foreign('agent')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('document_id')
                ->references('id')
                ->on('documents')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('projetprevisionnel_id')
                ->references('id')
                ->on('projet_previsionnels')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projets');
    }
}
