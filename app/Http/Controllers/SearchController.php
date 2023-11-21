<?php

namespace App\Http\Controllers;

use App\Repositories\ParoisseRepositoryInterface;
use App\Repositories\ProvinceRepositoryInterface;
use App\Repositories\RegionRepositoryInterface;
use App\Repositories\ClasseurRepositoryInterface;
use App\Repositories\DomaineRepositoryInterface;
use App\Repositories\PartenaireRepositoryInterface;
use App\Repositories\SecteurRepositoryInterface;
use App\Repositories\CommuneRepositoryInterface;
use App\Repositories\MetadonneRepositoryInterface;
use App\Repositories\TypepartenaireRepositoryInterface;
use App\Repositories\ProjetRepositoryInterface;

class SearchController extends Controller
{
    protected $communeRepo;
    protected $paroisseRepo;
    protected $regionRepo;
    protected $domaineRepo;
    protected $provinceRepo;
    protected $typeRepo;
    protected $secteurRepo;
    protected $partenaireRepo;
    protected $projetRepo;

    public function __construct(
        CommuneRepositoryInterface $commune,
        RegionRepositoryInterface $region,
        ProvinceRepositoryInterface $province,
        SecteurRepositoryInterface $secteur,
        DomaineRepositoryInterface $domaine,
        TypepartenaireRepositoryInterface $type,
        PartenaireRepositoryInterface $partenaire,
        ParoisseRepositoryInterface $paroisse,
        ProjetRepositoryInterface $projet
    ) {
        $this->middleware('auth');
        $this->communeRepo = $commune;
        $this->paroisseRepo = $paroisse;
        $this->regionRepo = $region;
        $this->provinceRepo = $province;
        $this->typeRepo = $type;
        $this->partenaireRepo = $partenaire;
        $this->secteurRepo = $secteur;
        $this->domaineRepo = $domaine;
        $this->projetRepo = $projet;
    }

    public function index()
    {
        $projets = [];

        return view('recherche.index', [
            'projets' => $projets,
            'types' => $this->typeRepo->all(),
            'provinces' => $this->provinceRepo->all(),
            'regions' => $this->regionRepo->all(),
            'paroisses' => $this->paroisseRepo->all(),
            'domaines' => $this->domaineRepo->all(),
            'communes' => $this->communeRepo->all(),
            'partenaires' => $this->partenaireRepo->all(),
            'secteurs' => $this->secteurRepo->all()
        ]);
    }


}
