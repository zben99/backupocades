<?php

namespace App\Repositories;

use App\Models\Paroisse;

class ParoisseRepository implements ParoisseRepositoryInterface
{
    public function get($id)
    {
        return Paroisse::where('id', $id)->firstOrFail();
    }

    public function add(array $data)
    {

        Paroisse::create([
            'paroisse' => $data["paroisse"],
            'description' => $data["description"],
            'commune_id' => $data["commune_id"],
        ]);
    }

    public function all()
    {
        return Paroisse::orderBy('paroisse')->get();
    }

    public function delete($id)
    {
        $paroisse = Paroisse::where('id', $id)->firstOrFail();
        $paroisse->delete();
    }

    public function update($id, array $data)
    {
        $paroisse = Paroisse::where('id', $id)->firstOrFail();

        $paroisse->update([
            'paroisse' => $data["paroisse"],
            'description' => $data["description"],
            'commune_id' => $data["commune_id"],
        ]);
    }
}
