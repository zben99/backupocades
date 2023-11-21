<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateFoundViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        CREATE OR REPLACE VIEW found_views
        AS
        SELECT projet_views.*,partenaire_views.partenaire_id,partenaire_views.commune_id,partenaire_views.typepartenaire_id, partenaire_views.region_id, partenaire_views.province_id,partenaire_views.paroisse_id,partenaire_views.domaine_id
        FROM
            projet_partenaire
            INNER JOIN partenaire_views ON projet_partenaire.partenaire_id=partenaire_views.partenaire_id
            INNER JOIN projet_views ON projet_partenaire.projet_id=projet_views.id
            ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('found_views');
    }
}