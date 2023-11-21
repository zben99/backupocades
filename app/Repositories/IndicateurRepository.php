<?php

namespace App\Repositories;

use App\Models\Indicateur;

class IndicateurRepository implements IndicateurRepositoryInterface
{
    public function get($id)
    {
        return Indicateur::where('id', $id)->firstOrFail();
    }

    public function add(array $data)
    {

        Indicateur::create([
            'nom' => $data["nom"],
            'type' => $data["type"],
            'valeur' => $data["valeur"],
            'activite_id' => $data["activite_id"],
        ]);
    }

    public function all()
    {
        return Indicateur::orderBy('nom')->get();
    }

    public function delete($id)
    {
        $indicateur = Indicateur::where('id', $id)->firstOrFail();
        $indicateur->delete();
    }

    public function update($id, array $data)
    {
        $indicateur = Indicateur::where('id', $id)->firstOrFail();

        $indicateur->update([
            'nom' => $data["nom"],
            'type' => $data["type"],
            'valeur' => $data["valeur"],
            'activite_id' => $data["activite_id"],
        ]);
    }
}
