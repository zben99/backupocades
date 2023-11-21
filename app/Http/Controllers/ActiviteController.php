<?php

namespace App\Http\Controllers;

use App\Repositories\ActiviteRepositoryInterface;
use App\Models\Activite;
use App\Models\Activitedocument;
use App\Repositories\DomaineRepositoryInterface;
use App\Repositories\ParoisseRepositoryInterface;
use App\Repositories\PartenaireRepositoryInterface;
use App\Repositories\ActivitedocumentRepositoryInterface;
use App\Repositories\IndicateurRepositoryInterface;
use App\Repositories\ActivitePrevisionnelleRepositoryInterface;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class ActiviteController extends Controller
{
    protected $activite;
    protected $activitePrevisionnelle;
    protected $domaine;
    protected $paroisse;
    protected $partenaire;
    protected $document;
    protected $indicateur;

    public function __construct(ActiviteRepositoryInterface $activite, ActivitePrevisionnelleRepositoryInterface $activitePrevisionnelle, DomaineRepositoryInterface $domaine, ParoisseRepositoryInterface $paroisse, PartenaireRepositoryInterface $partenaire, ActivitedocumentRepositoryInterface $document, IndicateurRepositoryInterface $indicateur)
    {
        $this->middleware('auth');
        $this->activite = $activite;
        $this->activitePrevisionnelle = $activitePrevisionnelle;
        $this->domaine = $domaine;
        $this->paroisse = $paroisse;
        $this->partenaire = $partenaire;
        $this->document = $document;
        $this->indicateur = $indicateur;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('activites.index', [
            'activites' => $this->activitePrevisionnelle->allActivites(),
            'activiteprevisionnelles' => $this->activitePrevisionnelle->all(),
            'domaines' => $this->domaine->all(),
            'paroisses' => $this->paroisse->all(),
            'partenaires' => $this->partenaire->all()
        ]);
    }

    public function show($id)
    {
        $activite = Activite::where('id', $id)->first();
        return view('activites.show', [
            'activite' => $activite,
        ]);
    }

    public function showDetails($id)
    {
        $activite = $this->activitePrevisionnelle->get($id);
        return view('activites.showActivite', [
            'activiteprevisionnelles' => $this->activitePrevisionnelle->all(),
            'activ' => $activite,
            'domaines' => $this->domaine->all(),
            'paroisses' => $this->paroisse->all(),
            'partenaires' => $this->partenaire->all()

        ]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'libelle' => '',
                'debut' => 'required',
                'unite_physique' => 'required',
                'quantite_realise' => 'required|nullable|integer',
                'cout_total_realisation' => 'required|numeric',
                'contrib_beneficiaire' => 'nullable',
                'bene_d_homme' => 'nullable|integer',
                'bene_d_femme' => 'nullable|integer',
                'activite_previsionnelle_id' => 'required|integer',
                'paroisse_id' => 'required',
                'domaine_id' => 'required',
            ],
            [
                //'contrib_beneficiaire.numeric' => 'Veuillez entrer un nombre',
                'cout_total_realisation.numeric' => 'Veuillez entrer un nombre',
                //'unite_physique.numeric' => 'Veuillez entrer un nombre',
                'bene_d_homme.integer' => 'Veuillez entrer un nombre entier',
                'bene_d_femme.integer' => 'Veuillez entrer un nombre entier',
                'quantite_realise.integer' => 'Veuillez entrer un nombre entier',
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
            $activiteCreate = $this->activite->add($request->all());
            $activiteCreate->partenaires()->sync($pivot);
            //$activiteCreate->save();
        }

        $tail = 0;
        if(isset($input['nom'])){
            $tail = count($input['nom']);
        }
        if ($tail != 0) {
            for ($i = 0; $i < $tail; $i++) {
                $pivotI = ['activite_id' => $activiteCreate->id, 'nom' => $input['nom'][$i], 'type' => $input['type'][$i], 'valeur' => $input['valeur'][$i]];
                $this->indicateur->add($pivotI);
            }
        }


        $this->validate($request, [
            'documents.*' => 'mimes:jpeg,png,jpg,gif,csv,txt,xlx,xls,pdf|max:4048'
        ]);

        if ($request->hasfile('documents')) {
            foreach ($request->file('documents') as $file) {
                $date = date("Y_m_d_H_i_s");
                $name = $date . "_" . $file->getClientOriginalName();
                $file->move(public_path() . '/activiteFiles/', $name);

                $this->document->add(['url' => $name, 'activite_id' => $activiteCreate->id]);
            }
        }

        Alert::success('Enregistrement Réussi', 'L\'activité a été ajoutée avec succès!');
        //return response()->json(['success' => 'true']);
    }

    public function update(Request $request)
    {

        $request->validate(
            [
                'libelle' => '',
                'debut' => 'required',
                'unite_physique' => 'required',
                'quantite_realise' => 'required|nullable|integer',
                'cout_total_realisation' => 'required|numeric',
                'contrib_beneficiaire' => 'nullable',
                'bene_d_homme' => 'nullable|integer',
                'bene_d_femme' => 'nullable|integer',
                'activite_previsionnelle_id' => 'required|integer',
                'paroisse_id' => 'required|integer',
                'domaine_id' => 'required|integer',
            ],
            [

                //'contrib_beneficiaire.numeric' => 'Veuillez entrer un nombre',
                'cout_total_realisation.numeric' => 'Veuillez entrer un nombre',
                //'unite_physique.integer' => 'Veuillez entrer un nombre',
                'bene_d_homme.integer' => 'Veuillez entrer un nombre entier',
                'bene_d_femme.integer' => 'Veuillez entrer un nombre entier',
                'quantite_realise.integer' => 'Veuillez entrer un nombre entier',
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
            $activiteCreate = $this->activite->update($request->code, $request->all());
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
                $pivotI = ['activite_id' => $activiteCreate->id, 'nom' => $input['nom'][$i], 'type' => $input['type'][$i], 'valeur' => $input['valeur'][$i]];
                $this->indicateur->add($pivotI);
            }
        }

        $this->validate($request, [
            'documents.*' => 'mimes:jpeg,png,jpg,gif,csv,txt,xlx,xls,pdf|max:2048'
        ]);

        if ($request->hasfile('documents')) {
            foreach ($request->file('documents') as $file) {
                $date = date("Y_m_d_H_i_s");
                $name = $date . "_" . $file->getClientOriginalName();
                $file->move(public_path() . '/activiteFiles/', $name);

                $this->document->add(['url' => $name, 'activite_id' => $activiteCreate->id]);
            }
        }

        Alert::success('Opération Réussie', 'L\'activité a été modifiée avec succès!');
        return response()->json(['success' => 'true']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\activite  $activite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->activite->delete($request->code);
        Alert::success('Suppression', 'L\'activité a été supprimée avec succès!');
        return redirect()->route('activites.index');
    }

    public function supprimerdocument($id)
    {
        $docu = Activitedocument::where('id', $id)->firstOrFail();
        $file = public_path() . '/activiteFiles/' . $docu->url;
        if (\File::exists($file)) {
            \File::delete($file);
        }
        $docu->delete();
        //Alert::success('Suppression', 'Le document a été supprimé avec succès!');

        return response()->json(['success' => 'true']);
    }
}
