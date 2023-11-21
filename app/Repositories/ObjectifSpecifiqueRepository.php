<?php

namespace App\Repositories;

use App\Models\ObjectifSpecifique;

class ObjectifSpecifiqueRepository implements ObjectifSpecifiqueRepositoryInterface
{
    public function get($id)
    {
        return ObjectifSpecifique::where('id', $id)->firstOrFail();
    }

    public function add(array $data)
    {

        ObjectifSpecifique::create([
            'nom' => $data["nom"],
            'description' => $data["description"],
        ]);
    }

    public function all()
    {
        return ObjectifSpecifique::orderBy('nom')->get();
    }

    public function delete($id)
    {
        $objectifSpecifique = ObjectifSpecifique::where('id', $id)->firstOrFail();
        $objectifSpecifique->delete();
    }

    public function update($id, array $data)
    {
        $objectifSpecifique = ObjectifSpecifique::where('id', $id)->firstOrFail();

        $objectifSpecifique->update([
            'nom' => $data["nom"],
            'description' => $data["description"],
        ]);
    }
}
