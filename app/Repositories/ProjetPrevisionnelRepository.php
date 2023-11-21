<?php

namespace App\Repositories;

use App\Models\ProjetPrevisionnel;
use App\Models\ProjetPrevisionnelPartenaire;
use App\Traits\ProjetTrait;
use Illuminate\Support\Facades\Auth;

class ProjetPrevisionnelRepository implements ProjetPrevisionnelRepositoryInterface
{
    use ProjetTrait;

    public function get($id)
    {
        return ProjetPrevisionnel::where('id', $id)->firstOrFail();
    }

    public function add(array $data)
    {

        $projet = ProjetPrevisionnel::create([
            'nom' => $data["nom"],
            'program_id' => $data["program_id"],
            'debut' => $data["debut"],
            'fin' => $data["fin"],
            'objectGeneral' => $data["objectGeneral"],
            'resultatAttendu' => $data["resultatAttendu"],
            'montant' => $data["montant"],
            'agent' => Auth::user()->id,
        ]);

        $projet->save();

        foreach ($data["parts"] as $value) {
            ProjetPrevisionnelPartenaire::create([
                "partenaire_id" => $value,
                "projet_previsionnel_id" => $projet->id,
            ]);
        }

        $this->recordProjetOperation($data["nom"], "Ajout du projet prévisionnel");
    }

    public function getDelete()
    {
        return ProjetPrevisionnel::onlyTrashed()->get();
    }

    public function all()
    {
        return ProjetPrevisionnel::orderBy('nom')->get();
    }

    public function delete($id)
    {
        $projetPrevisionnel = ProjetPrevisionnel::where('id', $id)->firstOrFail();
        $projetPrevisionnel->delete();
        $this->recordProjetOperation($projetPrevisionnel->nom, "suppression du projet prévisionnel");
    }

    public function update($id, array $data)
    {
        $projetPrevisionnel = ProjetPrevisionnel::where('id', $id)->firstOrFail();

        $projetPrevisionnel->update([
            'nom' => $data["nom"],
            'program_id' => $data["program_id"],
            'debut' => $data["debut"],
            'fin' => $data["fin"],
            'objectGeneral' => $data["objectGeneral"],
            'resultatAttendu' => $data["resultatAttendu"],
            'montant' => $data["montant"]
        ]);
        ProjetPrevisionnelPartenaire::where('projet_previsionnel_id', $id)->delete();

        foreach ($data["parts"] as $value) {
            ProjetPrevisionnelPartenaire::create([
                "partenaire_id" => $value,
                "projet_previsionnel_id" => $id,
            ]);
        }
        $this->recordProjetOperation($data["nom"], "Mise à jour du projet prévisionnel");
    }

    public function restore($projet_id)
    {
        $projet = ProjetPrevisionnel::withTrashed()->where('id', $projet_id)->first()->nom;
        $this->recordProjetOperation($projet, 'Restauration du projet prévisionnel.');
        ProjetPrevisionnel::withTrashed()->where('id', $projet_id)->restore();
    }

    public function forceDelete($projet_id)
    {
        ProjetPrevisionnel::where('id', $projet_id)->forceDelete();
    }
}
