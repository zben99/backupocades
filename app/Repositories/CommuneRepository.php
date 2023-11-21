<?php

namespace App\Repositories;

use App\Models\Commune;

class CommuneRepository implements CommuneRepositoryInterface
{
    public function get($id)
    {
        return Commune::where('id', $id)->firstOrFail();
    }

    public function add(array $data)
    {

        Commune::create([
            'commune' => $data["commune"],
            'description' => $data["description"],
            'province_id' => $data["province_id"],
        ]);
    }

    public function all()
    {
        return Commune::orderBy('commune')->get();
    }

    public function delete($id)
    {
        $commune = Commune::where('id', $id)->firstOrFail();
        $commune->delete();
    }

    public function update($id, array $data)
    {
        $commune = Commune::where('id', $id)->firstOrFail();

        $commune->update([
            'commune' => $data["commune"],
            'description' => $data["description"],
            'province_id' => $data["province_id"],
        ]);
    }
}
