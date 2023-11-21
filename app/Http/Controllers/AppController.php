<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\Projet;
use App\Models\Partenaire;
use App\Repositories\VieOrganisationRepositoryInterface;
use App\Models\Program;
use App\Repositories\ActivitePrevisionnelleRepositoryInterface;
use App\Repositories\ProjetPrevisionnelRepositoryInterface;

class AppController extends Controller
{
    protected $activitePrevisionnelle;
    protected $projet;
    protected $vieOrganisation;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ActivitePrevisionnelleRepositoryInterface $activitePrevisionnelle, VieOrganisationRepositoryInterface $vieOrganisation,ProjetPrevisionnelRepositoryInterface $projet)
    {
        $this->activitePrevisionnelle = $activitePrevisionnelle;
        $this->vieOrganisation = $vieOrganisation;
        $this->projet = $projet;
    }



    public function welcome()
    {
        return view('index', [
            'nbProjet' => count(Projet::all()),
            'nbActivite' => count($this->activitePrevisionnelle->allActivites()),
            'nbPart' => count(Partenaire::all()),
            'progs' => count(Program::all()),
            'documents' => $this->vieOrganisation->all(),
            'config'=>Config::first(),

        ]);
    }

    public function show($code)
    {
        return view('details', [
            'document' => $this->vieOrganisation->get($code),
            'config'=>Config::first(),
        ]);
    }
}
