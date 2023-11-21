<?php

namespace App\Repositories;

use App\Models\FichierDocument;
use App\Models\Historique;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class HistoriqueRepository implements HistoriqueRepositoryInterface
{

    public function add($projet, $motif)
    {
        Historique::create([
            'projet' => $projet,
            'motif' => $motif,
            'agent' => Auth::user()->id,
        ]);
    }

    public function all()
    {
        return Historique::all();
    }

    public function delete($code)
    {
        Historique::where('id', $code)->delete();
    }

    public function vider()
    {
        $all = Historique::all();
        foreach ($all as $value) {
            Historique::destroy($value->id);
        }
    }
}