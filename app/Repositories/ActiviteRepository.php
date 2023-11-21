<?php

namespace App\Repositories;

use App\Models\Activite;
use App\Models\Projet;
use App\Traits\ProjetTrait;
use Illuminate\Support\Facades\Auth;

class ActiviteRepository implements ActiviteRepositoryInterface
{
    use ProjetTrait;

    public function get($id)
    {
        return Activite::where('id', $id)->firstOrFail();
    }

    public function add(array $data)
    {

        $act = Activite::create([
            'libelle' => $data["libelle"],
            'date_realisation' => $data["debut"],
            'unite_physique' => $data["unite_physique"],
            'quantite_realise' => $data["quantite_realise"],
            'cout_total_realisation' => $data["cout_total_realisation"],
            'contrib_beneficiaire' => $data["contrib_beneficiaire"],
            'bene_d_homme' => $data["bene_d_homme"],
            'bene_d_femme' => $data["bene_d_femme"],
            'activite_previsionnelle_id' => $data["activite_previsionnelle_id"],
            'paroisse_id' => $data["paroisse_id"],
            'observation' => $data["observation"],
            'type_beneficiaire' => $data["type_beneficiaire"],
            'domaine_id' =>  $data["domaine_id"],
            'agent' => Auth::user()->id,
        ]);

        $nom = $act->activitePrevisionnelle->projetPrevisionnel->nom;
        $this->recordProjetOperation($nom, "Ajout de l'activité : " . $data["libelle"]);

        return $act;
    }

    public function all()
    {
        return Activite::orderBy('libelle')->get();
    }

    public function delete($id)
    {
        $activite = Activite::where('id', $id)->firstOrFail();
        // $this->recordProjetOperation($activite->projetPrevisionnel->nom, "Suppression de l'activité : " . $activite->libelle);
        $activite->delete();
    }

    public function update($id, array $data)
    {
        $activite = Activite::where('id', $id)->firstOrFail();

        $activite->update([
            'libelle' => $data["libelle"],
            'date_realisation' => $data["debut"],
            'unite_physique' => $data["unite_physique"],
            'quantite_realise' => $data["quantite_realise"],
            'cout_total_realisation' => $data["cout_total_realisation"],
            'contrib_beneficiaire' => $data["contrib_beneficiaire"],
            'bene_d_homme' => $data["bene_d_homme"],
            'bene_d_femme' => $data["bene_d_femme"],
            'activite_previsionnelle_id' => $data["activite_previsionnelle_id"],
            'paroisse_id' => $data["paroisse_id"],
            'observation' => $data["observation"],
            'type_beneficiaire' => $data["type_beneficiaire"],
            'domaine_id' =>  $data["domaine_id"]
        ]);

        $nom = $activite->activitePrevisionnelle->projetPrevisionnel->nom;
        $this->recordProjetOperation($nom, "Mise à jour de l'activité : " . $data["libelle"]);
        return $activite;
    }
}
