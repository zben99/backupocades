<?php

namespace App\Repositories;

use App\Models\Village;

class VillageRepository implements VillageRepositoryInterface
{
    public function get($id)
    {
        return Village::where('id', $id)->firstOrFail();
    }

    public function add(array $data)
    {

        Village::create([
            'village' => $data["village"],
            'description' => $data["description"],
            'paroisse_id' => $data["paroisse_id"],
        ]);
    }

    public function all()
    {
        return Village::orderBy('village')->get();
    }

    public function delete($id)
    {
        $village = Village::where('id', $id)->firstOrFail();
        $village->delete();
    }

    public function update($id, array $data)
    {
        $village = Village::where('id', $id)->firstOrFail();

        $village->update([
            'village' => $data["village"],
            'description' => $data["description"],
            'paroisse_id' => $data["paroisse_id"],
        ]);
    }
}
