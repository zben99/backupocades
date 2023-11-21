<?php

namespace App\Repositories;

use App\Models\Domaine;

class DomaineRepository implements DomaineRepositoryInterface
{
    public function get($id)
    {
        return Domaine::where('id', $id)->firstOrFail();
    }

    public function add(array $data)
    {

        Domaine::create([
            'domaine' => $data["domaine"],
            'description' => $data["description"],
            'secteur_id' => $data["secteur_id"],
        ]);
    }

    public function all()
    {
        return Domaine::orderBy('domaine')->get();
    }

    public function delete($id)
    {
        $domaine = Domaine::where('id', $id)->firstOrFail();
        $domaine->delete();
    }

    public function update($id, array $data)
    {
        $domaine = Domaine::where('id', $id)->firstOrFail();

        $domaine->update([
            'domaine' => $data["domaine"],
            'description' => $data["description"],
            'secteur_id' => $data["secteur_id"],
        ]);
    }
}
