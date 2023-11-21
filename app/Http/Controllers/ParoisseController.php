<?php

namespace App\Http\Controllers;

use App\Repositories\ParoisseRepositoryInterface;
use App\Repositories\CommuneRepositoryInterface;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ParoisseController extends Controller
{
    protected $paroisse;
    protected $commune;

    public function __construct(ParoisseRepositoryInterface $paroisse, CommuneRepositoryInterface $commune)
    {
        $this->middleware('auth');
        $this->paroisse = $paroisse;
        $this->commune = $commune;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('parametres.paroisses.index', [
            'paroisses' => $this->paroisse->all(),
            'communes' => $this->commune->all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'paroisse' => 'required',
                'description' => '',
                'commune_id' => 'required',
            ],
        );

        $this->paroisse->add($request->all());
        Alert::success('Enregistrement Réussi', 'La paroisse a été ajoutée avec succès!');
        return response()->json(['success' => 'true']);
    }

    public function update(Request $request)
    {

        $request->validate(
            [
                'code' => 'required',
                'paroisse' => 'required',
                'description' => '',
                'commune_id' => 'required',
            ],
        );


        $this->paroisse->update($request->code, $request->all());
        Alert::success('Opération Réussie', 'La paroisse a été modifiée avec succès!');
        return response()->json(['success' => 'true']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\paroisse  $paroisse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->paroisse->delete($request->code);
        Alert::success('Suppression', 'La paroisse  a été supprimée avec succès!');

        return redirect()->route('paroisses.index');
    }
}
