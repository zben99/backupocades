<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailFinancementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_financements', function (Blueprint $table) {
            $table->id();
            $table->double('montant');
            $table->string('description')->nullable();
            $table->unsignedBigInteger('activite_id');
            $table->foreign('activite_id')->references('id')->on('activites')->onDelete('cascade');
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
        Schema::dropIfExists('detail_financements');
    }
}
