<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitePrevisionnellesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activite_previsionnelles', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->integer('quantite')->default(0);
            $table->double('cout')->nullable();
            $table->unsignedBigInteger('projet_previsionnel_id');
            $table->foreign('projet_previsionnel_id')->references('id')->on('projet_previsionnels')->onDelete('cascade');
            $table->unsignedBigInteger('commune_id');
            $table->foreign('commune_id')->references('id')->on('communes')->onDelete('cascade');
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
        Schema::dropIfExists('activite_previsionnelles');
    }
}
