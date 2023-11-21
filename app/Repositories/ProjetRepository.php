<?php

namespace App\Repositories;

use App\Models\Document;
use App\Models\Projet;
use App\Traits\ProjetTrait;
use Illuminate\Support\Facades\Auth;

class ProjetRepository implements ProjetRepositoryInterface
{
    use ProjetTrait;

    public function get($id)
    {
        return Projet::where('id', $id)->firstOrFail();
    }

    public function getDelete()
    {
        return Projet::onlyTrashed()->get();
    }

    public function add(array $data)
    {

        $projet = Projet::create([
            'libelle' => $data["libelle"],
            'description' => $data["description"],
            'budget' => $data["budget"],
            'montantCharge' => $data["montantCharge"],
            'montantEquipement' => $data["montantEquipement"],
            'chefProjet' => $data["chefProjet"],
            'debut' => $data["debut"],
            'fin' => $data["fin"],
            'depenseBeneficiaire' => $data["depenseBeneficiaire"],
            'montantTotalDepense' => $data["montantTotalDepense"],
            'projetprevisionnel_id' => $data["projet_previsionnel_id"],
            'agent' => Auth::user()->id,
        ]);

        $this->recordProjetOperation($data["libelle"], "Ajout du projet");
        return $projet;
    }

    public function all()
    {
        return Projet::orderBy('libelle')->get();
    }

    public function delete($id)
    {
        $projet = Projet::where('id', $id)->firstOrFail();
        $projet->delete();
        $this->recordProjetOperation($projet->libelle, "suppression du projet");
    }

    public function update($id, array $data)
    {
        $projet = Projet::where('id', $id)->firstOrFail();

        $projet->update([
            'libelle' => $data["libelle"],
            'description' => $data["description"],
            'budget' => $data["budget"],
            'montantCharge' => $data["montantCharge"],
            'montantEquipement' => $data["montantEquipement"],
            'chefProjet' => $data["chefProjet"],
            'debut' => $data["debut"],
            'fin' => $data["fin"],
            'depenseBeneficiaire' => $data["depenseBeneficiaire"],
            'montantTotalDepense' => $data["montantTotalDepense"],
            'projetprevisionnel_id' => $data["projet_previsionnel_id"]
        ]);
        $this->recordProjetOperation($data["libelle"], "Mise à jour du projet");

        return $projet;
    }

    public function restore($projet_id)
    {
        $projet = Projet::withTrashed()->where('id', $projet_id)->first()->libelle;
        $this->recordProjetOperation($projet, 'Restauration du projet.');
        Projet::withTrashed()->where('id', $projet_id)->restore();
    }

    public function forceDelete($projet_id)
    {
        Projet::where('id', $projet_id)->forceDelete();
    }
}
