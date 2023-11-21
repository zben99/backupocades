<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateParoisseViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        CREATE OR REPLACE VIEW paroisse_views
        AS
        SELECT paroisses.*,commune_views.region_id, commune_views.province_id
        FROM
            paroisses
            INNER JOIN commune_views ON paroisses.commune_id=commune_views.id
            ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paroisse_views');
    }
}