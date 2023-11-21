<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Repositories\HistoriqueRepositoryInterface;

class HistoriqueController extends Controller
{

    protected $historique;
    public function __construct(HistoriqueRepositoryInterface $historique)
    {
        $this->middleware('auth');

        $this->historique = $historique;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('historique.index', [
            'operations' => $this->historique->all(),
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\historique  $historique
     * @return \Illuminate\Http\Response
     */
    public function vider()
    {
        $this->historique->vider();
        Alert::success('Suppression Historique', 'L\'historique  a été vidé avec succès!');
        return redirect()->route('projet-history.index');
    }

    //Supprimer un element de l'historique des avenants
    public function destroy(Request $request)
    {
        $nom = $request->nom;
        $this->historique->delete($request->code);
        Alert::success('Suppression Historique', 'L\'historique ' . $request->nom . ' a été supprimé avec succès!');
        return redirect()->route('projet-history.index');
    }
}