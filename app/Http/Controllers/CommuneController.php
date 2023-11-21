<?php

namespace App\Http\Controllers;

use App\Repositories\CommuneRepositoryInterface;
use App\Repositories\ProvinceRepositoryInterface;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CommuneController extends Controller
{
    protected $commune;
    protected $province;

    public function __construct(CommuneRepositoryInterface $commune, ProvinceRepositoryInterface $province)
    {
        $this->middleware('auth');
        $this->commune = $commune;
        $this->province = $province;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('parametres.communes.index', [
            'communes' => $this->commune->all(),
            'provinces' => $this->province->all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'commune' => 'required',
                'description' => '',
                'province_id' => 'required',
            ],
        );

        $this->commune->add($request->all());
        Alert::success('Enregistrement Réussi', 'La commune a été ajoutée avec succès!');
        return response()->json(['success' => 'true']);
    }

    public function update(Request $request)
    {

        $request->validate(
            [
                'code' => 'required',
                'commune' => 'required',
                'description' => '',
                'province_id' => 'required',
            ],
        );


        $this->commune->update($request->code, $request->all());
        Alert::success('Opération Réussie', 'La commune a été modifiée avec succès!');
        return response()->json(['success' => 'true']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\commune  $commune
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->commune->delete($request->code);
        Alert::success('Suppression', 'La commune a été supprimée avec succès!');

        return redirect()->route('communes.index');
    }
}
