<?php

namespace App\Repositories;

use App\Models\Partenaire;

class PartenaireRepository implements PartenaireRepositoryInterface
{
    public function get($id)
    {
        return Partenaire::where('id', $id)->firstOrFail();
    }

    public function add(array $data)
    {

        Partenaire::create([
            'nom' => $data["nom"],
            'description' => $data["description"],
            'telephone' => $data["telephone"],
            'email' => $data["email"],
            'adresse' => $data["adresse"],
            'typepartenaire_id' => $data["typepartenaire_id"],
        ]);
    }

    public function all()
    {
        return Partenaire::orderBy('nom')->get();
    }

    public function delete($id)
    {
        $partenaire = Partenaire::where('id', $id)->firstOrFail();
        $partenaire->delete();
    }

    public function update($id, array $data)
    {
        $partenaire = Partenaire::where('id', $id)->firstOrFail();

        $partenaire->update([
            'nom' => $data["nom"],
            'description' => $data["description"],
            'telephone' => $data["telephone"],
            'email' => $data["email"],
            'adresse' => $data["adresse"],
            'typepartenaire_id' => $data["typepartenaire_id"],
        ]);
    }
}
