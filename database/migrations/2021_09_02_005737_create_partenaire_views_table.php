<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePartenaireViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        CREATE OR REPLACE VIEW partenaire_views
        AS
        SELECT detail_financements.*,partenaires.typepartenaire_id, activite_views.commune_id, activite_views.region_id, activite_views.province_id,activite_views.paroisse_id,activite_views.domaine_id
        FROM
            detail_financements
            INNER JOIN activite_views ON detail_financements.activite_id=activite_views.id
            INNER JOIN partenaires ON detail_financements.partenaire_id=partenaires.id

            ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partenaire_views');
    }
}