<?php

namespace App\Http\Controllers;

use App\Repositories\SecteurRepositoryInterface;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SecteurController extends Controller
{
    protected $secteur;

    public function __construct(SecteurRepositoryInterface $secteur)
    {
        $this->middleware('auth');
        $this->secteur = $secteur;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('parametres.secteurs.index', [
            'secteurs' => $this->secteur->all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nom' => 'required',
                'description' => '',
            ],
        );

        $this->secteur->add($request->all());
        Alert::success('Enregistrement Réussi', 'Le secteur a été ajouté avec succès!');
        return response()->json(['success' => 'true']);
    }

    public function update(Request $request)
    {

        $request->validate(
            [
                'code' => 'required',
                'nom' => 'required',
                'description' => '',
            ],
        );


        $this->secteur->update($request->code, $request->all());
        Alert::success('Opération Réussie', 'Le secteur a été modifié avec succès!');
        return response()->json(['success' => 'true']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\secteur  $secteur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->secteur->delete($request->code);
        Alert::success('Suppression', 'Le secteur a été supprimé avec succès!');

        return redirect()->route('secteurs.index');
    }
}
