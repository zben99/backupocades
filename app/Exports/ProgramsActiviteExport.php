<?php

namespace App\Exports;

use App\Models\Activite;
use App\Models\Domaine;
use App\Models\Secteur;
use App\Models\ObjectifSpecifique;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProgramsActiviteExport implements FromView, ShouldAutoSize
{
    private $dateD;
    private $dateF;

    public function __construct($dateD, $dateF){
        $this->dateF = $dateF;
        $this->dateD = $dateD;
    }

    public function view(): View
    {
        $user = Auth::user();
        $activites = array();
        $data = [];
     
        //Test si l'utilisateur a le droit admin ou gestionnaire
        if ($user->hasAnyRole(['admin', 'gestionnaire']) {
            $data = Activite::all();
        }
        else{
            $data = Activite::where('agent',$user->id)->get();
        }
        $dd = $this->dateD;
        $df = $this->dateF;
        $data = $data->filter(function ($dat) use($dd, $df) {
            if (isset($dat->date_realisation)) {
                return ((date(\Carbon\Carbon::parse($dat->date_realisation)->translatedFormat('Y-m-d')) >= $dd) && (date(\Carbon\Carbon::parse($dat->date_realisation)->translatedFormat('Y-m-d')) <= $df));
            }

        });

        foreach ($data as $value) {
            //$domaine = Domaine::withTrashed(true)->whereId($value->domaine_id)->first();



            //$secteur = Secteur::withTrashed(true)->whereId($domaine->secteur_id)->first();

            $objectifs = $value->activitePrevisionnelle->objectif_specifiques;

            foreach($objectifs as $objectif){

                if (isset($activites[$objectif->nom])) {
                    array_push($activites[$objectif->nom], $value);
                }
                else{
                    $activites[$objectif->nom] = [$value];
                }
            }
        }
        return view('programs.rapportImprimer', [
            'activites' => $activites,
            'dateD' => $this->dateD,
            'dateF' => $this->dateF,
        ]);
    }
}
