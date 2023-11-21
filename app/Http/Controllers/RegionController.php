<?php

namespace App\Http\Controllers;

use App\Repositories\RegionRepositoryInterface;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RegionController extends Controller
{
    protected $region;
    public function __construct(RegionRepositoryInterface $region)
    {
        $this->middleware('auth');

        $this->region = $region;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('parametres.regions.index', [
            'regions' => $this->region->all(),
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

        $this->region->add($request->all());
        Alert::success('Enregistrement Réussi', 'La region a été ajoutée avec succès!');
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


        $this->region->update($request->code, $request->all());

        Alert::success('Opération Réussie', 'La region a été modifiée avec succès!');
        return response()->json(['success' => 'true']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\region  $region
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $nom = $this->region->get($request->code)->nom;
        $this->region->delete($request->code);
        Alert::success('Suppression', 'La region ' . $nom . ' a été supprimée avec succès!');

        return redirect()->route('regions.index');
    }
}
