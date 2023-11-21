<?php

namespace App\Http\Controllers;

use App\Repositories\PartenaireRepositoryInterface;
use App\Repositories\TypepartenaireRepositoryInterface;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PartenaireController extends Controller
{
    protected $partenaire;
    protected $typepartenaire;

    public function __construct(PartenaireRepositoryInterface $partenaire, TypepartenaireRepositoryInterface $typepartenaire)
    {
        $this->middleware('auth');
        $this->partenaire = $partenaire;
        $this->typepartenaire = $typepartenaire;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('parametres.partenaires.index', [
            'partenaires' => $this->partenaire->all(),
            'typepartenaires' => $this->typepartenaire->all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nom' => 'required',
                'description' => '',
                'telephone' => '',
                'email' => '',
                'adresse' => '',
                'typepartenaire_id' => 'required',
            ],
        );

        $this->partenaire->add($request->all());
        Alert::success('Enregistrement Réussi', 'Le partenaire a été ajouté avec succès!');
        return response()->json(['success' => 'true']);
    }

    public function update(Request $request)
    {

        $request->validate(
            [
                'code' => 'required',
                'nom' => 'required',
                'description' => '',
                'telephone' => '',
                'email' => '',
                'adresse' => '',
                'typepartenaire_id' => 'required',
            ],
        );


        $this->partenaire->update($request->code, $request->all());
        Alert::success('Opération Réussie', 'Le partenaire a été modifié avec succès!');
        return response()->json(['success' => 'true']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\partenaire  $partenaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->partenaire->delete($request->code);
        Alert::success('Suppression', 'Le partenaire a été supprimé avec succès!');

        return redirect()->route('partenaires.index');
    }
}
