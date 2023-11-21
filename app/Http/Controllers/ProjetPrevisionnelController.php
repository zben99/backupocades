<?php

namespace App\Http\Controllers;

use App\Models\ProjetPrevisionnel;
use App\Repositories\PartenaireRepositoryInterface;
use App\Repositories\ProjetPrevisionnelRepositoryInterface;
use App\Repositories\ProgramRepositoryInterface;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProjetPrevisionnelController extends Controller
{
    protected $partenaire;
    protected $projetPrevisionnel;

    public function __construct(PartenaireRepositoryInterface $partenaire, ProgramRepositoryInterface $program, ProjetPrevisionnelRepositoryInterface $projetPrevisionnel)
    {
        $this->middleware('auth');
        $this->partenaire = $partenaire;
        $this->projetPrevisionnel = $projetPrevisionnel;
        $this->program = $program;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('projets_previsionnels.index', [
            'partenaires' => $this->partenaire->all(),
            'projetPrevisionnels' => $this->projetPrevisionnel->all(),
            'programs' => $this->program->all(),
        ]);
    }

    public function store(Request $request)
    {

        $request->validate(
            [
                'nom' => 'required',
                'program_id' => 'required',
                'debut' => 'required',
                'fin' => 'required',
                'montant' => '',
                'resultatAttendu' => 'required',
                'objectGeneral' => 'required',
                'parts' => 'required',
            ],
        );

        $this->projetPrevisionnel->add($request->all());
        Alert::success('Enregistrement Réussi', 'Le projet prévisionnel a été ajouté avec succès!');
        return response()->json(['success' => 'true']);
    }

    public function update(Request $request)
    {

        $request->validate(
            [
                'code' => 'required',
                'program_id' => 'required',
                'nom' => 'required',
                'debut' => 'required',
                'fin' => 'required',
                'montant' => '',
                'resultatAttendu' => 'required',
                'objectGeneral' => 'required',
                'parts' => 'required',
            ],
        );


        $this->projetPrevisionnel->update($request->code, $request->all());
        Alert::success('Opération Réussie', 'Le projet prévisionnel a été modifié avec succès!');
        return response()->json(['success' => 'true']);
    }

    public function show($code)
    {
        $projetPrevisionnel = ProjetPrevisionnel::withTrashed()->where('id', $code)->first();
        return view('projets_previsionnels.show', [
            'projetPrevisionnel' => $projetPrevisionnel,
        ]);
    }

    public function projets_supprimes()
    {
        return view('projets_previsionnels.restaurer.index', [
            'projetPrevisionnels' => $this->projetPrevisionnel->getDelete(),
        ]);
    }


    public function restore($code)
    {
        $this->projetPrevisionnel->restore($code);
        Alert::success('Restauration', 'Le projet prévisionnel a été restauré avec succès!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\projetPrevisionnelPrevisionnel  $projetPrevisionnelPrevisionnel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->projetPrevisionnel->delete($request->code);
        Alert::success('Suppression', 'Le projet prévisionnel a été supprimé avec succès!');
        return redirect()->route('projets-previsionnels.index');
    }

    public function delete(Request $request)
    {
        $this->projetPrevisionnel->forceDelete($request->code);
        Alert::success('Suppression Totale', 'Le projet prévisionnel  a été supprimé avec succès!');

        return back();
    }
}
