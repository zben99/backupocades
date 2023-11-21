<?php

namespace App\Repositories;

use App\Models\Indicateurprev;

class IndicateurprevRepository implements IndicateurprevRepositoryInterface
{
    public function get($id)
    {
        return Indicateurprev::where('id', $id)->firstOrFail();
    }

    public function add(array $data)
    {

        Indicateurprev::create([
            'nom' => $data["nom"],
            'type' => $data["type"],
            'valeur' => $data["valeur"],
            'activite_previsionnelle_id' => $data["activite_previsionnelle_id"],
        ]);
    }

    public function all()
    {
        return Indicateurprev::orderBy('nom')->get();
    }

    public function delete($id)
    {
        $indicateurprev = Indicateurprev::where('id', $id)->firstOrFail();
        $indicateurprev->delete();
    }

    public function update($id, array $data)
    {
        $indicateurprev = Indicateurprev::where('id', $id)->firstOrFail();

        $indicateurprev->update([
            'nom' => $data["nom"],
            'type' => $data["type"],
            'valeur' => $data["valeur"],
            'activite_previsionnelle_id' => $data["activite_previsionnelle_id"],
        ]);
    }
}
