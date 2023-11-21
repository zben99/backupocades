<?php

namespace App\Http\Livewire\Projets;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Searchprojet extends Component
{
    public $regions;
    public $provinces;
    public $communes;
    public $paroisses;
    public $partenaires;
    public $secteurs;
    public $domaines;
    public $types;

    public $data;
    private $projets = array();
    public $indice;
    public $type;
    public $partenaire;
    public $debut;
    public $fin;
    public $secteur;
    public $commune;
    public $paroisse;
    public $region;
    public $domaine;
    public $province;

    private $query;
    public $search;
    public $okBtn;
    public $parts;


    public function mount($regions, $paroisses, $secteurs, $provinces, $domaines, $types, $partenaires, $communes)
    {
        //variable permettant de savoir si on a cliquer ou pas sur rechercher
        $this->okBtn = 0;
        $this->regions = $regions;
        $this->provinces = $provinces;
        $this->types = $types;
        $this->communes = $communes;
        $this->paroisses = $paroisses;
        $this->secteurs = $secteurs;
        $this->domaines = $domaines;
        $this->partenaires = $partenaires;
    }

    public function updated()
    {
        $this->okBtn = 0;
    }

    public function render()
    {
        return view('livewire.projets.searchprojet', [
            'types' => $this->types,
            'domaines' => $this->domaines,
            'partenaires' => $this->partenaires,
            'provinces' => $this->provinces,
            'secteurs' => $this->secteurs,
            'regions' => $this->regions,
            'ok' => $this->okBtn,
            'projets' => $this->projets,
            'communes' => $this->communes,
            'paroisses' => $this->paroisses,
        ]);
    }

    //Reinitialise les valeurs des champs
    public function resetFields()
    {
        $this->okBtn = 0;
        $this->indice = "";
        $this->type = "";
        $this->partenaire = "";
        $this->debut = "";
        $this->fin = "";
        $this->region = "";
        $this->secteur = "";
        $this->domaine = "";
        $this->province = "";
        $this->commune = "";
        $this->paroisse = "";
    }

    public function found()
    {
        $this->data = $this->validate([
            'province' => '',
            'indice' => '',
            'partenaire' => '',
            'type' => '',
            'domaine' => '',
            'secteur' => '',
            'debut' => '',
            'fin' => '',
            'region' => '',
            'commune' => '',
            'paroisse' => '',
        ]);

        if ($this->data['indice'] != '') {
            $req = str_replace(' ', '%', $this->data['indice']);
            $this->query = $this->query . " libelle like '%" . $req . "%' and ";
        }

        if ($this->data['region'] != '') {
            $this->query = $this->query . " region_id like '" . $this->data['region'] . "' and ";
        }

        if ($this->data['type'] != '') {
            $this->query = $this->query . " typepartenaire_id = '" . $this->data['type'] . "' and";
        }

        if ($this->data['partenaire'] != '') {
            $this->query = $this->query . " partenaire_id = '" . $this->data['partenaire'] . "' and";
        }

        if ($this->data['debut'] != null) {
            $this->query = $this->query . " debut >= '" . $this->data['debut'] . "' and";
        }

        if ($this->data['fin'] != null) {
            $this->query = $this->query . " fin <= '" . $this->data['fin'] . "' and";
        }

        if ($this->data['secteur'] != null) {
            $this->query = $this->query . " secteur_id = '" . $this->data['secteur'] . "' and";
        }

        if ($this->data['commune'] != null) {
            $this->query = $this->query . " commune_id = '" . $this->data['commune'] . "' and";
        }

        if ($this->data['paroisse'] != null) {
            $this->query = $this->query . " paroisse_id = '" . $this->data['paroisse'] . "' and";
        }


        if ($this->data['domaine'] != null) {
            $this->query = $this->query . " domaine_id = '" . $this->data['domaine'] . "' and";
        }

        if ($this->data['province'] != null) {
            $this->query = $this->query . " province_id = '" . $this->data['province'] . "' and ";
        }

        if ($this->query == null) {
            session()->flash('Alert', "Veuillez choisir au moins un critère de recherche !!!");
        } else {
            $this->search = "select distinct id,libelle, description, agent from found_views where " . $this->query . " deleted_at is null";
            $this->projets = DB::select(DB::raw($this->search));
            $this->okBtn = 1;
        }
    }
}
