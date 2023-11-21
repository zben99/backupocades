<?php

namespace App\Http\Controllers;

use App\Repositories\ObjectifSpecifiqueRepositoryInterface;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ObjectifSpecifiqueController extends Controller
{
    protected $objectifSpecifique;

    public function __construct(ObjectifSpecifiqueRepositoryInterface $objectifSpecifique)
    {
        $this->middleware('auth');
        $this->objectifSpecifique = $objectifSpecifique;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('parametres.objectifs.index', [
            'objectifs' => $this->objectifSpecifique->all(),
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

        $this->objectifSpecifique->add($request->all());
        Alert::success('Enregistrement Réussi', 'L\'objectif spécifique a été ajouté avec succès!');
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

        $this->objectifSpecifique->update($request->code, $request->all());
        Alert::success('Opération Réussie', 'L\'objectif spécifique a été modifié avec succès!');
        return response()->json(['success' => 'true']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\objectifSpecifique  $objectifSpecifique
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->objectifSpecifique->delete($request->code);
        Alert::success('Suppression', 'L\'objectif spécifique a été supprimé avec succès!');

        return redirect()->route('objectif-specifiques.index');
    }
}
