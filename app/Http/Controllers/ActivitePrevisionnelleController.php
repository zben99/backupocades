<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Repositories\RegionRepositoryInterface;
use App\Repositories\CommuneRepositoryInterface;
use App\Repositories\DomaineRepositoryInterface;
use App\Repositories\VillageRepositoryInterface;
use App\Repositories\ParoisseRepositoryInterface;
use App\Repositories\ProvinceRepositoryInterface;
use App\Repositories\PartenaireRepositoryInterface;
use App\Repositories\IndicateurprevRepositoryInterface;
use App\Repositories\ObjectifSpecifiqueRepositoryInterface;
use App\Repositories\ProjetPrevisionnelRepositoryInterface;
use App\Repositories\ActivitePrevisionnelleRepositoryInterface;

class ActivitePrevisionnelleController extends Controller
{
    protected $activitePrevisionnelle;
    protected $projet;
    protected $commune;
    protected $domaine;
    protected $paroisse;
    protected $village;
    protected $province;
    protected $indicateur;
    protected $region;
    protected $partenaire;
    protected $objectif;

    public function __construct(ActivitePrevisionnelleRepositoryInterface $activitePrevisionnelle, ProjetPrevisionnelRepositoryInterface $projet, CommuneRepositoryInterface $commune, DomaineRepositoryInterface $domaine, PartenaireRepositoryInterface $partenaire, IndicateurprevRepositoryInterface $indicateur,ParoisseRepositoryInterface $paroisse,ProvinceRepositoryInterface $province,RegionRepositoryInterface $region, VillageRepositoryInterface $village,ObjectifSpecifiqueRepositoryInterface $objectif)
    {
        $this->middleware('auth');
        $this->activitePrevisionnelle = $activitePrevisionnelle;
        $this->projet = $projet;
        $this->commune = $commune;
        $this->domaine = $domaine;
        $this->paroisse = $paroisse;
        $this->village = $village;
        $this->province = $province;
        $this->indicateur = $indicateur;
        $this->region = $region;
        $this->partenaire = $partenaire;
        $this->objectif = $objectif;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('activites_previsionnelles.index', [
            'activitePrevisionnelles' => $this->activitePrevisionnelle->all(),
            'projets' => $this->projet->all(),
            'communes' => $this->commune->all(),
            'domaines' => $this->domaine->all(),
            'paroisses' => $this->paroisse->all(),
            'villages' => $this->village->all(),
            'provinces' => $this->province->all(),
            'regions' => $this->region->all(),
            'partenaires' => $this->partenaire->all(),
            'objectifs' => $this->objectif->all(),
        ]);
    }

    public function show($id)
    {
        $activite = $this->activitePrevisionnelle->get($id);
        return view('activites_previsionnelles.show', [
            'activiteprevisionnelles' => $this->activitePrevisionnelle->all(),
            'activite' => $activite,
            'domaines' => $this->domaine->all(),
            'paroisses' => $this->paroisse->all(),
            'partenaires' => $this->partenaire->all()

        ]);
    }

    public function getIndicators($id)
    {
        $activite = $this->activitePrevisionnelle->get($id);
        return  $activite->indicateurs;
    }

    public function getPartners($id)
    {
        $activite = $this->activitePrevisionnelle->get($id);
        return  $activite->partenaires;
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'libelle' => 'required',
                'quantite' => '',
                'cout' => '',
                'projet' => 'required',
                'debut' => 'required',
                'unite_physique' => 'required',
                'village_id' => 'required',
                'paroisse_id' => 'required',
                'commune_id' => 'required',
                'contrib_beneficiaire' => 'nullable',
                'bene_d_homme' => 'nullable|integer',
                'bene_d_femme' => 'nullable|integer',
                'region_id' => 'required',
                'domaine_id' => 'required',
                'region_id' => 'required',
                'objectSpecifique' => 'required',
            ],
            [
                //'contrib_beneficiaire.numeric' => 'Veuillez entrer un nombre',
                'cout.numeric' => 'Veuillez entrer un nombre',
                //'unite_physique.numeric' => 'Veuillez entrer un nombre',
                'bene_d_homme.integer' => 'Veuillez entrer un nombre entier',
                'bene_d_femme.integer' => 'Veuillez entrer un nombre entier',
                'quantite.integer' => 'Veuillez entrer un nombre entier',
            ]
        );


        $input = $request->all();
        $pivot = null;
        $pivotI = null;
        $taille = 0;
        $activiteCreate  = null;
        if(isset($input['partenaireSel'])){
          $taille = count($input['partenaireSel']);
        }
        if ($taille != 0) {
            for ($i = 0; $i < $taille; $i++) {
                $pivot[] = ['partenaire_id' => $input['partenaireSel'][$i], 'montant' => $input['montant'][$i], 'description' => $input['description'][$i]];
            }
        }
        if ($pivot != null) {
            $activiteCreate = $this->activitePrevisionnelle->add($request->all());
            $activiteCreate->partenaires()->sync($pivot);
            //$activiteCreate->save();
        }

        $tail = 0;
        if(isset($input['nom'])){
            $tail = count($input['nom']);
        }
        if ($tail != 0) {
            for ($i = 0; $i < $tail; $i++) {
                $pivotI = ['activite_previsionnelle_id' => $activiteCreate->id, 'nom' => $input['nom'][$i], 'type' => $input['type'][$i], 'valeur' => $input['valeur'][$i]];
                $this->indicateur->add($pivotI);
            }
        }
        /*if(isset($input['province_id']))
        $activiteCreate->provinces()->sync($input['province_id']);*/

        if(isset($input['commune_id']))
        $activiteCreate->communes()->sync($input['commune_id']);

        if(isset($input['village_id']))
        $activiteCreate->villages()->sync($input['village_id']);

        if(isset($input['paroisse_id']))
        $activiteCreate->paroisses()->sync($input['paroisse_id']);
        Alert::success('Enregistrement Réussi', 'L\'activite prévisionnelle a été ajoutée avec succès!');
        return response()->json(['success' => 'true']);
    }

    public function update(Request $request)
    {

        $request->validate(
            [
                'code' => 'required',
                'libelle' => 'required',
                'quantite' => '',
                'cout' => '',
                'projet' => 'required',
                'debut' => 'required',
                'unite_physique' => 'required',
                'contrib_beneficiaire' => 'nullable',
                'bene_d_homme' => 'nullable|integer',
                'bene_d_femme' => 'nullable|integer',
                'region_id' => 'required',
                'domaine_id' => 'required',
                'region_id' => 'required',
                'objectSpecifique' => 'required',
                'village_id' => 'required',
                'paroisse_id' => 'required',
                'commune_id' => 'required',
            ],
            [
                //'contrib_beneficiaire.numeric' => 'Veuillez entrer un nombre',
                'cout.numeric' => 'Veuillez entrer un nombre',
                //'unite_physique.numeric' => 'Veuillez entrer un nombre',
                'bene_d_homme.integer' => 'Veuillez entrer un nombre entier',
                'bene_d_femme.integer' => 'Veuillez entrer un nombre entier',
                'quantite.integer' => 'Veuillez entrer un nombre entier',
            ]
        );



        $input = $request->all();
        $pivot = null;
        $pivotI = null;
        $taille = 0;
        if(isset($input['partenaireSel'])){
          $taille = count($input['partenaireSel']);
        }
        if ($taille != 0) {
            for ($i = 0; $i < $taille; $i++) {
                $pivot[] = ['partenaire_id' => $input['partenaireSel'][$i], 'montant' => $input['montant'][$i], 'description' => $input['description'][$i]];
            }
        }
        if ($pivot != null) {
            $activiteCreate = $this->activitePrevisionnelle->update($request->code, $request->all());
            $activiteCreate->partenaires()->detach();
            $activiteCreate->partenaires()->sync($pivot);
            //$activiteCreate->save();
        }

        $tail = 0;
        if(isset($input['nom'])){
            $tail = count($input['nom']);
        }
        if ($tail != 0) {
            $activiteCreate->indicateurs()->delete();
            for ($i = 0; $i < $tail; $i++) {
                $pivotI = ['activite_previsionnelle_id' => $activiteCreate->id, 'nom' => $input['nom'][$i], 'type' => $input['type'][$i], 'valeur' => $input['valeur'][$i]];
                $this->indicateur->add($pivotI);
            }
        }
        /*$activiteCreate->provinces()->detach();
        if(isset($input['province_id']))
        $activiteCreate->provinces()->sync($input['province_id']);*/
        $activiteCreate->communes()->detach();
        if(isset($input['commune_id']))
        $activiteCreate->communes()->sync($input['commune_id']);
        $activiteCreate->villages()->detach();
        if(isset($input['village_id']))
        $activiteCreate->villages()->sync($input['village_id']);
        $activiteCreate->paroisses()->detach();
        if(isset($input['paroisse_id']))
        $activiteCreate->paroisses()->sync($input['paroisse_id']);
        Alert::success('Opération Réussie', 'L\'activite prévisionnelle a été modifiée avec succès!');
        return response()->json(['success' => 'true']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\activitePrevisionnelle  $activitePrevisionnelle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->activitePrevisionnelle->delete($request->code);
        Alert::success('Suppression', 'L\'activite previsionnelle a été supprimée avec succès!');

        return redirect()->route('activites-previsionnelles.index');
    }
}
