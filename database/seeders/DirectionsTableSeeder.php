<?php

namespace Database\Seeders;

use App\Models\Direction;
use Illuminate\Database\Seeder;

class DirectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Direction::create([
            "nom_dir" => "Direction"
        ]);
        Direction::create([
            "nom_dir" => "DSI"
        ]);
    }
}
