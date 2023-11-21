<?php

namespace App\Repositories;

use App\Models\ActivitePrevisionnelle;
use App\Models\ActivitePrevObjectif;
use App\Models\ProjetPrevisionnel;
use App\Traits\ProjetTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ActivitePrevisionnelleRepository implements ActivitePrevisionnelleRepositoryInterface
{
    use ProjetTrait;

    public function get($id)
    {
        return ActivitePrevisionnelle::where('id', $id)->with(['projetPrevisionnel','partenaires','indicateurs','objectif_specifiques'])->first();
    }

    public function add(array $data)
    {

        $activite = ActivitePrevisionnelle::create([
            'libelle' => $data["libelle"],
            'quantite' => $data["quantite"],
            'cout' => $data["cout"],
            'projet_previsionnel_id' => $data["projet"],
            'agent' => Auth::user()->id,
            'date_realisation' => $data["debut"],
            'unite_physique' => $data["unite_physique"],
            'contrib_beneficiaire' => $data["contrib_beneficiaire"],
            'bene_d_homme' => $data["bene_d_homme"],
            'bene_d_femme' => $data["bene_d_femme"],
            'region_id' => $data["region_id"],
            'observation' => $data["observation"],
            'type_beneficiaire' => $data["type_beneficiaire"],
            'domaine_id' =>  $data["domaine_id"],
            //'commune_id' => $data["commune"],
        ]);

        foreach ($data["objectSpecifique"] as $value) {
            ActivitePrevObjectif::create([
                "objectif_specifique_id" => $value,
                "activite_prev_id" => $activite->id,
            ]);
        }

        $projet = ProjetPrevisionnel::where('id', $data["projet"])->first();

        $this->recordProjetOperation($projet->nom, "Ajout de l'activité prévisionnel: " . $data["libelle"]);
        return $activite;
    }

    public function all()
    {
        return ActivitePrevisionnelle::orderBy('libelle')->get();
    }

    public function allActivites()
    {
        $ids = DB::select('select distinct activite_previsionnelle_id from activites where deleted_at is null');
        $array = [];
        foreach ($ids as $key => $value) {
            $array[$key] = $value->activite_previsionnelle_id;
        }
        $activites = ActivitePrevisionnelle::whereIn('id', $array)->get();
        return $activites;
    }

    public function delete($id)
    {
        $activitePrevisionnelle = ActivitePrevisionnelle::where('id', $id)->firstOrFail();
        $this->recordProjetOperation($activitePrevisionnelle->projetPrevisionnel->nom, "Suppression de l'activité prévisionnel: " . $activitePrevisionnelle->libelle);
        $activitePrevisionnelle->delete();
    }

    public function update($id, array $data)
    {
        $activitePrevisionnelle = ActivitePrevisionnelle::where('id', $id)->firstOrFail();

        $activitePrevisionnelle->update([
            'libelle' => $data["libelle"],
            'quantite' => $data["quantite"],
            'cout' => $data["cout"],
            'projet_previsionnel_id' => $data["projet"],
            'date_realisation' => $data["debut"],
            'unite_physique' => $data["unite_physique"],
            'contrib_beneficiaire' => $data["contrib_beneficiaire"],
            'bene_d_homme' => $data["bene_d_homme"],
            'bene_d_femme' => $data["bene_d_femme"],
            'region_id' => $data["region_id"],
            'observation' => $data["observation"],
            'type_beneficiaire' => $data["type_beneficiaire"],
            'domaine_id' =>  $data["domaine_id"],
        ]);

        ActivitePrevObjectif::where('activite_prev_id', $id)->delete();

        foreach ($data["objectSpecifique"] as $value) {
            ActivitePrevObjectif::create([
                "objectif_specifique_id" => $value,
                "activite_prev_id" => $id,
            ]);
        }

        $projet = ProjetPrevisionnel::where('id', $data["projet"])->first();
        $this->recordProjetOperation($projet->nom, "Mise à jour de l'activité prévisionnel: " . $data["libelle"]);
        return $activitePrevisionnelle;
    }
}
