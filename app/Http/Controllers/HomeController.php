<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\Projet;
use App\Models\ProjetPrevisionnel;
use App\Models\ActivitePrevisionnelle;
use App\Models\Partenaire;
use App\Models\Program;
use App\Models\User;
use App\Repositories\ActivitePrevisionnelleRepositoryInterface;
use App\Repositories\ProjetPrevisionnelRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected $activitePrevisionnelle;
    protected $projet;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ActivitePrevisionnelleRepositoryInterface $activitePrevisionnelle, ProjetPrevisionnelRepositoryInterface $projet)
    {
        $this->middleware(['auth']);
        $this->activitePrevisionnelle = $activitePrevisionnelle;
        $this->projet = $projet;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user()->id;
        return view('home', [
            'news' => count(User::all()),
            'nbProjet' => count(Projet::all()),
            'nbProjetU' => count(Projet::where('agent',$user)->get()),
            'nbProjetP' => count(ProjetPrevisionnel::all()),
            'nbProjetPU' => count(ProjetPrevisionnel::where('agent',$user)->get()),
            'nbActivite' => count($this->activitePrevisionnelle->allActivites()),
            'nbActiviteU' => count(Activite::where('agent',$user)->get()),
            'nbActiviteP' => count(ActivitePrevisionnelle::all()),
            'nbActivitePU' => count(ActivitePrevisionnelle::where('agent',$user)->get()),
            'nbPart' => count(Partenaire::all()),
            'delPrev' => count(ProjetPrevisionnel::onlyTrashed()->get()),
            'delProj' => count(Projet::onlyTrashed()->get()),
            'progs' => count(Program::all()),
            'progsU' => count(Program::where('agent',$user)->get()),
            'proj3' => Projet::latest()->take(3)->get(),

        ]);
    }

    public function getProjectDetails($id)
    {
        $data = $this->projet->get($id);
        return response()->json($data);
    }

    public function getActivitePrevDetails($id)
    {
        $data = $this->activitePrevisionnelle->get($id);
        return response()->json($data);
    }
}
