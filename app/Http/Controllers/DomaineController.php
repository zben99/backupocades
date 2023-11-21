<?php

namespace App\Http\Controllers;

use App\Repositories\DomaineRepositoryInterface;
use App\Repositories\SecteurRepositoryInterface;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DomaineController extends Controller
{
    protected $domaine;
    protected $secteur;

    public function __construct(DomaineRepositoryInterface $domaine, SecteurRepositoryInterface $secteur)
    {
        $this->middleware('auth');
        $this->domaine = $domaine;
        $this->secteur = $secteur;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('parametres.domaines.index', [
            'domaines' => $this->domaine->all(),
            'secteurs' => $this->secteur->all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'domaine' => 'required',
                'description' => '',
                'secteur_id' => 'required',
            ],
        );

        $this->domaine->add($request->all());
        Alert::success('Enregistrement Réussi', 'Le domaine a été ajouté avec succès!');
        return response()->json(['success' => 'true']);
    }

    public function update(Request $request)
    {

        $request->validate(
            [
                'code' => 'required',
                'domaine' => 'required',
                'description' => '',
                'secteur_id' => 'required',
            ],
        );


        $this->domaine->update($request->code, $request->all());
        Alert::success('Opération Réussie', 'Le domaine a été modifié avec succès!');
        return response()->json(['success' => 'true']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\domaine  $domaine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->domaine->delete($request->code);
        Alert::success('Suppression', 'Le domaine a été supprimé avec succès!');

        return redirect()->route('domaines.index');
    }
}