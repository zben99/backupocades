<?php

namespace App\Http\Controllers;

use App\Repositories\TypepartenaireRepositoryInterface;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TypepartenaireController extends Controller
{
    protected $typepartenaire;

    public function __construct(TypepartenaireRepositoryInterface $typepartenaire)
    {
        $this->middleware('auth');
        $this->typepartenaire = $typepartenaire;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('parametres.typepartenaires.index', [
            'typepartenaires' => $this->typepartenaire->all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'libelle' => 'required',
            ],
        );

        $this->typepartenaire->add($request->all());
        Alert::success('Enregistrement Réussi', 'Le type de partenaire a été ajouté avec succès!');
        return response()->json(['success' => 'true']);
    }

    public function update(Request $request)
    {

        $request->validate(
            [
                'code' => 'required',
                'libelle' => 'required',
            ],
        );


        $this->typepartenaire->update($request->code, $request->all());
        Alert::success('Opération Réussie', 'Le type de partenaire a été modifié avec succès!');
        return response()->json(['success' => 'true']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\typepartenaire  $typepartenaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->typepartenaire->delete($request->code);
        Alert::success('Suppression', 'Le type de partenaire a été supprimé avec succès!');

        return redirect()->route('typepartenaires.index');
    }
}
