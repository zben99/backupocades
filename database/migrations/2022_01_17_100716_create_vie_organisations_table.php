<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVieOrganisationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vie_organisations', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('auteur');
            $table->integer('nb_pages');
            $table->text('resume');
            $table->string('logo');
            $table->date('date_publication');
            $table->unsignedBigInteger('type_document_id');
            $table->foreign('type_document_id')->references('id')->on('type_documents')->onDelete('cascade');
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
        Schema::dropIfExists('vie_organisations');
    }
}
