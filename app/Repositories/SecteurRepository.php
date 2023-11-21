<?php

namespace App\Repositories;

use App\Models\Secteur;

class SecteurRepository implements SecteurRepositoryInterface
{
    public function get($id)
    {
        return Secteur::where('id', $id)->firstOrFail();
    }

    public function add(array $data)
    {

        Secteur::create([
            'nom' => $data["nom"],
            'description' => $data["description"],
        ]);
    }

    public function all()
    {
        return Secteur::orderBy('nom')->get();
    }

    public function delete($id)
    {
        $secteur = Secteur::where('id', $id)->firstOrFail();
        $secteur->delete();
    }

    public function update($id, array $data)
    {
        $secteur = Secteur::where('id', $id)->firstOrFail();

        $secteur->update([
            'nom' => $data["nom"],
            'description' => $data["description"],
        ]);
    }
}
