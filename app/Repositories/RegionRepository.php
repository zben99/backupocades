<?php

namespace App\Repositories;

use App\Models\Region;

class RegionRepository implements RegionRepositoryInterface
{
    public function get($id)
    {
        return Region::where('id', $id)->firstOrFail();
    }

    public function add(array $data)
    {

        Region::create([
            'nom' => $data["nom"],
            'description' => $data["description"],
        ]);
    }

    public function all()
    {
        return Region::orderBy('nom')->get();
    }

    public function delete($id)
    {
        $region = Region::where('id', $id)->firstOrFail();
        $region->delete();
    }

    public function update($id, array $data)
    {
        $region = Region::where('id', $id)->firstOrFail();

        $region->update([
            'nom' => $data["nom"],
            'description' => $data["description"],
        ]);
    }
}
