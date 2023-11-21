<?php

namespace App\Http\Controllers;

use App\Repositories\ProjetRepositoryInterface;
use App\Models\Projet;
use App\Models\Paroisse;
use App\Models\Secteur;
use App\Models\Activite;
use App\Models\Document;
use App\Models\ActivitePrevisionnelle;
use App\Repositories\DocumentRepositoryInterface;
use App\Repositories\ProjetPrevisionnelRepositoryInterface;
use App\Repositories\PartenaireRepositoryInterface;
use App\Repositories\SecteurRepositoryInterface;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProjetController extends Controller
{
    protected $projet;
    protected $secteur;
    protected $partenaire;
    protected $projetprevisionnel;
    protected $document;

    public function __construct(ProjetRepositoryInterface $projet, DocumentRepositoryInterface $document, ProjetPrevisionnelRepositoryInterface $projetprevisionnel, PartenaireRepositoryInterface $partenaire, SecteurRepositoryInterface $secteur)
    {
        $this->middleware('auth');
        $this->projet = $projet;
        $this->secteur = $secteur;
        $this->partenaire = $partenaire;
        $this->projetprevisionnel = $projetprevisionnel;
        $this->document = $document;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('projets.index', [
            'projets' => $this->projet->all(),
            'secteurs' => $this->secteur->all(),
            'partenaires' => $this->partenaire->all(),
            'projetprevisionnels' => $this->projetprevisionnel->all(),
            'documents' => $this->document->all(),
        ]);
    }

    public function statistique()
    {
        $statAct = [];
        $statActP = [];
        $statPro = [];
        $statProP = [];
        $projets = $this->projet->all();
        $paroisses = Paroisse::all();
        $activites = Activite::all();
        $secteurs = Secteur::all();
        $activitesP = ActivitePrevisionnelle::all();
        $projetsP = $this->projetprevisionnel->all();
        foreach ($activites as $activite) {
            if (isset($statAct[$activite->paroisse->paroisse])) {
                $statAct[$activite->paroisse->paroisse]++;
            } else {
                $statAct[$activite->paroisse->paroisse] = 1;
            }
        }

        // foreach ($activitesP as $activite) {
        //     if (isset($statActP[$activite->commune->commune])) {
        //         $statActP[$activite->commune->commune]++;
        //     } else {
        //         $statActP[$activite->commune->commune] = 1;
        //     }
        // }

        foreach ($secteurs as $secteur) {
            $statPro[$secteur->nom] = 0;
        }

        foreach ($projets as $projet) {
            foreach ($projet->secteurs as $secteur) {
                $statPro[$secteur->nom]++;
            }
        }

        foreach ($projetsP as $pro) {
            $statProP[$pro->nom] = count($pro->activites);
        }


        return view('projets.statistique', [
            'statAct' => $statAct,
            'statActP' => $statActP,
            'statPro' => $statPro,
            'statProP' => $statProP,
        ]);
    }

    public function show($id)
    {
        $projet = Projet::where('id', $id)->first();
        return view('projets.show', [
            'projet' => $projet,
        ]);
    }


    public function projets_supprimes()
    {
        return view('projets.restaurer.index', [
            'projets' => $this->projet->getDelete(),
        ]);
    }


    public function restore($code)
    {
        $this->projet->restore($code);
        Alert::success('Restauration', 'Le projet a été restauré avec succès!');
        return back();
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'libelle' => 'required|string|max:191',
                'description' => 'required',
                'secteur' => 'required',
                'budget' => 'required|numeric',
                'montantCharge' => 'required|numeric',
                'montantEquipement' => 'required|numeric',
                'chefProjet' => 'required|string|max:191',
                'debut' => 'required|date',
                'fin' => 'required|date',
                'depenseBeneficiaire' => 'required|numeric',
                'montantTotalDepense' => 'required|numeric',
                'projet_previsionnel_id' => 'required|integer',
            ],
            [

                'budget.numeric' => 'Veuillez entrer un nombre',
                'montantCharge.numeric' => 'Veuillez entrer un nombre',
                'montantEquipement.numeric' => 'Veuillez entrer un nombre',
                'depenseBeneficiaire.numeric' => 'Veuillez entrer un nombre',
                'montantTotalDepense.numeric' => 'Veuillez entrer un nombre',
            ]
        );

        $input = $request->all();
        $pivot = null;
        $taille = count($input['partenaireSel']);
        if ($taille != 0) {
            for ($i = 0; $i < $taille; $i++) {
                $pivot[] = ['partenaire_id' => $input['partenaireSel'][$i], 'montant' => $input['montant'][$i], 'description' => $input['descriptions'][$i]];
            }
        }
        if ($pivot != null) {
            $projetCreate = $this->projet->add($request->all());
            $projetCreate->partenaires()->sync($pivot);
        }

        $pivot = null;
        $taille = count($input['secteur']);
        if ($taille != 0) {
            for ($i = 0; $i < $taille; $i++) {
                $pivot[] = ['secteur_id' => $input['secteur'][$i], 'projet_id' => $projetCreate->id];
            }
        }
        if ($pivot != null) {
            $projetCreate->secteurs()->sync($pivot);
        }

        $this->validate($request, [
            'documents.*' => 'mimes:jpeg,png,jpg,gif,csv,txt,xlx,xls,pdf|max:4048'
        ]);

        if ($request->hasfile('documents')) {
            foreach ($request->file('documents') as $file) {
                $date = date("Y_m_d_H_i_s");
                $name = $date . "_" . $file->getClientOriginalName();
                $file->move(public_path() . '/projetFiles/', $name);

                $this->document->add(['url' => $name, 'projet_id' => $projetCreate->id]);
            }
        }

        Alert::success('Enregistrement Réussi', 'Le projet a été ajouté avec succès!');
        return response()->json(['success' => 'true']);
    }

    public function update(Request $request)
    {

        $request->validate(
            [
                'libelle' => 'required|string|max:191',
                'description' => 'required',
                'secteur' => 'required',
                'budget' => 'required|numeric',
                'montantCharge' => 'required|numeric',
                'montantEquipement' => 'required|numeric',
                'chefProjet' => 'required|string|max:191',
                'debut' => 'required|date',
                'fin' => 'required|date',
                'depenseBeneficiaire' => 'required|numeric',
                'montantTotalDepense' => 'required|numeric',
                'projet_previsionnel_id' => 'required|integer',
            ],
            [

                'budget.numeric' => 'Veuillez entrer un nombre',
                'montantCharge.numeric' => 'Veuillez entrer un nombre',
                'montantEquipement.numeric' => 'Veuillez entrer un nombre',
                'depenseBeneficiaire.numeric' => 'Veuillez entrer un nombre',
                'montantTotalDepense.numeric' => 'Veuillez entrer un nombre',
            ]
        );


        $input = $request->all();
        $pivot = null;
        $taille = count($input['partenaireSel']);
        if ($taille != 0) {
            for ($i = 0; $i < $taille; $i++) {
                $pivot[] = ['partenaire_id' => $input['partenaireSel'][$i], 'montant' => $input['montant'][$i], 'description' => $input['descriptions'][$i]];
            }
        }
        if ($pivot != null) {
            $projetCreate = $this->projet->update($request->code, $request->all());

            $projetCreate->partenaires()->detach();
            $projetCreate->partenaires()->sync($pivot);
        }

        $pivot = null;
        $taille = count($input['secteur']);
        if ($taille != 0) {
            for ($i = 0; $i < $taille; $i++) {
                $pivot[] = ['secteur_id' => $input['secteur'][$i], 'projet_id' => $projetCreate->id];
            }
        }
        if ($pivot != null) {
            $projetCreate->secteurs()->detach();
            $projetCreate->secteurs()->sync($pivot);
        }

        $this->validate($request, [
            'documents.*' => 'mimes:jpeg,png,jpg,gif,csv,txt,xlx,xls,pdf|max:4048'
        ]);

        if ($request->hasfile('documents')) {
            foreach ($request->file('documents') as $file) {
                $date = date("Y_m_d_H_i_s");
                $name = $date . "_" . $file->getClientOriginalName();
                $file->move(public_path() . '/projetFiles/', $name);

                $this->document->add(['url' => $name, 'projet_id' => $projetCreate->id]);
            }
        }

        Alert::success('Opération Réussie', 'Le projet a été modifié avec succès!');
        return response()->json(['success' => 'true']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\projet  $projet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->projet->delete($request->code);
        Alert::success('Suppression', 'Le projet a été supprimé avec succès!');

        return redirect()->route('projets.index');
    }

    public function delete(Request $request)
    {
        $this->projet->forceDelete($request->code);
        Alert::success('Suppression Totale', 'Le projet a été supprimé avec succès!');
        return back();
    }

    public function supprimerdocument($id)
    {
        $docu = Document::where('id', $id)->firstOrFail();
        $file = public_path() . '/projetFiles/' . $docu->url;
        if (\File::exists($file)) {
            \File::delete($file);
        }
        $docu->delete();
        //Alert::success('Suppression', 'Le document a été supprimé avec succès!');

        return response()->json(['success' => 'true']);
    }
}
