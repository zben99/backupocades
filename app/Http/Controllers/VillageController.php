<?php

namespace App\Http\Controllers;

use App\Repositories\VillageRepositoryInterface;
use App\Repositories\ParoisseRepositoryInterface;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class VillageController extends Controller
{
    protected $village;
    protected $paroisse;

    public function __construct(VillageRepositoryInterface $village, ParoisseRepositoryInterface $paroisse)
    {
        $this->middleware('auth');
        $this->village = $village;
        $this->paroisse = $paroisse;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('parametres.villages.index', [
            'villages' => $this->village->all(),
            'paroisses' => $this->paroisse->all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'village' => 'required',
                'description' => '',
                'paroisse_id' => 'required',
            ],
        );

        $this->village->add($request->all());
        Alert::success('Enregistrement Réussi', 'Le village a été ajoutée avec succès!');
        return response()->json(['success' => 'true']);
    }

    public function update(Request $request)
    {

        $request->validate(
            [
                'code' => 'required',
                'village' => 'required',
                'description' => '',
                'paroisse_id' => 'required',
            ],
        );


        $this->village->update($request->code, $request->all());
        Alert::success('Opération Réussie', 'Le village a été modifiée avec succès!');
        return response()->json(['success' => 'true']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\village  $village
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->village->delete($request->code);
        Alert::success('Suppression', 'Le village a été supprimée avec succès!');

        return redirect()->route('villages.index');
    }
}
