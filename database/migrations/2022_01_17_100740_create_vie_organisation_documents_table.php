<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVieOrganisationDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vie_organisation_documents', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->unsignedBigInteger('vie_organisation_id');
            $table->foreign('vie_organisation_id')->references('id')->on('vie_organisations')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vie_organisation_documents');
    }
}
