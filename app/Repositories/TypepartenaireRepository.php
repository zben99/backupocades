<?php

namespace App\Repositories;

use App\Models\Typepartenaire;

class TypepartenaireRepository implements TypepartenaireRepositoryInterface
{
    public function get($id)
    {
        return Typepartenaire::where('id', $id)->firstOrFail();
    }

    public function add(array $data)
    {

        Typepartenaire::create([
            'libelle' => $data["libelle"],
        ]);
    }

    public function all()
    {
        return Typepartenaire::orderBy('libelle')->get();
    }

    public function delete($id)
    {
        $typepartenaire = Typepartenaire::where('id', $id)->firstOrFail();
        $typepartenaire->delete();
    }

    public function update($id, array $data)
    {
        $typepartenaire = Typepartenaire::where('id', $id)->firstOrFail();

        $typepartenaire->update([
            'libelle' => $data["libelle"],
        ]);
    }
}
