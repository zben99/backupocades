<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjetPartenaireTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projet_partenaire', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('projet_id');
            $table->foreignId('partenaire_id');
            $table->decimal('montant', 20, 2);
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();


            $table->foreign('projet_id')
                ->references('id')
                ->on('projets')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('partenaire_id')
                ->references('id')
                ->on('partenaires')
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
        Schema::dropIfExists('projet_partenaire');
    }
}