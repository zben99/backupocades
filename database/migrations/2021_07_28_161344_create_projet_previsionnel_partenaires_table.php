<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjetPrevisionnelPartenairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projet_previsionnel_partenaires', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('partenaire_id');
            $table->foreignId('projet_previsionnel_id');
            $table->timestamps();

            $table->foreign('partenaire_id')
                ->references('id')
                ->on('partenaires')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('projet_previsionnel_id')
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
        Schema::dropIfExists('projet_previsionnel_partenaires');
    }
}