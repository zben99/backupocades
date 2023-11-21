<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjetSecteurTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projet_secteur', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('projet_id');
            $table->foreignId('secteur_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('projet_id')
                ->references('id')
                ->on('projets')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('secteur_id')
                ->references('id')
                ->on('secteurs')
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
        Schema::dropIfExists('projet_secteur');
    }
}