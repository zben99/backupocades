<?php

namespace App\Http\Controllers;

use App\Repositories\ProvinceRepositoryInterface;
use App\Repositories\RegionRepositoryInterface;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProvinceController extends Controller
{
    protected $province;
    protected $region;

    public function __construct(ProvinceRepositoryInterface $province, RegionRepositoryInterface $region)
    {
        $this->middleware('auth');
        $this->province = $province;
        $this->region = $region;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('parametres.provinces.index', [
            'provinces' => $this->province->all(),
            'regions' => $this->region->all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'province' => 'required',
                'description' => '',
                'region_id' => 'required',
            ],
        );

        $this->province->add($request->all());
        Alert::success('Enregistrement Réussi', 'La province a été ajoutée avec succès!');
        return response()->json(['success' => 'true']);
    }

    public function update(Request $request)
    {

        $request->validate(
            [
                'code' => 'required',
                'province' => 'required',
                'description' => '',
                'region_id' => 'required',
            ],
        );


        $this->province->update($request->code, $request->all());
        Alert::success('Opération Réussie', 'La province a été modifiée avec succès!');
        return response()->json(['success' => 'true']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\province  $province
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->province->delete($request->code);
        Alert::success('Suppression', 'La province  a été supprimée avec succès!');

        return redirect()->route('provinces.index');
    }
}
