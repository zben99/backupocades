<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateActiviteViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        CREATE OR REPLACE VIEW activite_views
        AS
        SELECT activites.*,paroisse_views.commune_id, paroisse_views.region_id, paroisse_views.province_id
        FROM
            activites
            INNER JOIN paroisse_views ON activites.paroisse_id=paroisse_views.id

            ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activite_views');
    }
}