<?php

use App\Models\Activite;
use App\Models\ActivitePrevisonnelleObjectif;
use App\Models\ActivitePrevObjectif;
use App\Models\Direction;
use App\Models\Projet;
use App\Models\ProjetPrevisionnel;
use App\Models\ProjetPrevisionnelObjectif;
use App\Models\ProjetPrevisionnelPartenaire;
use App\Models\ProjetSecteur;
use App\Models\User;

if (!function_exists('page_title')) {
    function page_title($title)
    {
        $base_title = config('app.name');
        if ($title === '') {
            return $base_title;
        } else {
            return $title . ' | ' . $base_title;
        }
    }
}

//Fonction helper permettant d'activer l'onglet qui a été selectionné
if (!function_exists('set_active_route')) {
    //La fonction helpers is de route nous dit si on est dans la route donnée en parametre
    function set_active_route($route)
    {
        return request()->routeIs($route) ? 'active' : '';
    }
}

//Fonction helper permettant de retrouver la direction d'un utilisateur
if (!function_exists('getUserDirection')) {
    function getUserDirection($user)
    {
        $direction = Direction::select('nom_dir')->where('id', $user)->first();
        return $direction['nom_dir'];
    }
}

function truncate($str, $width) {
    return strtok(wordwrap($str, $width, "...\n"), "\n");
}

//Fonction helper permettant de retrouver le proprietaire d'un utilisateur ou d'un element
if (!function_exists('getOwner')) {
    function getOwner($user)
    {
        if ($user == 0) {
            return "admin";
        }
        $owner = User::select('username')->where('id', $user)->first();
        return $owner['username'];
    }
}

//Fonction helper permettant de recuperer les id des partenaires associe å un projet previsionnel
if (!function_exists('getProjetPrevPartners')) {
    function getProjetPrevPartners($code)
    {
        $partners = ProjetPrevisionnelPartenaire::where('projet_previsionnel_id', $code)->get();
        $partner = "";
        foreach ($partners as $value) {
            if ($partner == "") {
                $partner = $value->partenaire_id;
            } else {
                $partner = $partner . "," . $value->partenaire_id;
            }
        }
        return $partner;
    }
}

if (!function_exists('getProjetPrevObj')) {
    function getProjetPrevObj($code)
    {
        $objects = ActivitePrevObjectif::where('activite_prev_id', $code)->get();
        $resp = "";
        foreach ($objects as $value) {
            if ($resp == "") {
                $resp = $value->objectif_specifique_id;
            } else {
                $resp = $resp . "," . $value->objectif_specifique_id;
            }
        }
        return $resp;
    }
}


if (!function_exists('getSecteurs')) {
    function getSecteurs($code)
    {
        $secteurs = Projet::where('id', $code)->first()->secteurs;
        $return = "";
        foreach ($secteurs as $value) {
            if ($return == "") {
                $return = $value->nom;
            } else {
                $return = $return . "," . $value->nom;
            }
        }
        return $return;
    }
}

if (!function_exists('getActiviteCoutTotal')) {
    function getActiviteCoutTotal($code)
    {
        $activites = Activite::where('activite_previsionnelle_id', $code)->get();
        $return = 0;
        foreach ($activites as $value) {
            $return = $return + $value->cout_total_realisation;
        }
        return $return;
    }
}

if (!function_exists('getActiviteQuantiteTotal')) {
    function getActiviteQuantiteTotal($code)
    {
        $activites = Activite::where('activite_previsionnelle_id', $code)->get();
        $return = 0;
        foreach ($activites as $value) {
            $return = $return + $value->quantite_realise;
        }
        return $return;
    }
}

if (!function_exists('getActiviteContribTotal')) {
    function getActiviteContribTotal($code)
    {
        $activites = Activite::where('activite_previsionnelle_id', $code)->get();
        $return = 0;
        foreach ($activites as $value) {
            $return = $return + $value->contrib_beneficiaire;
        }
        return $return;
    }
}

if (!function_exists('getActiviteHommeTotal')) {
    function getActiviteHommeTotal($code)
    {
        $activites = Activite::where('activite_previsionnelle_id', $code)->get();
        $return = 0;
        foreach ($activites as $value) {
            $return = $return + $value->bene_d_homme;
        }
        return $return;
    }
}

if (!function_exists('getActiviteFemmeTotal')) {
    function getActiviteFemmeTotal($code)
    {
        $activites = Activite::where('activite_previsionnelle_id', $code)->get();
        $return = 0;
        foreach ($activites as $value) {
            $return = $return + $value->bene_d_femme;
        }
        return $return;
    }
}

if (!function_exists('getActiviteUniteTotal')) {
    function getActiviteUniteTotal($code)
    {
        $activites = Activite::where('activite_previsionnelle_id', $code)->get();
        $return = 0;
        foreach ($activites as $value) {
            $return = $return + $value->unite_physique;
        }
        return $return;
    }
}

if (!function_exists('getBudget')) {
    function getBudget($code)
    {
        $result=0;
        $projets = ProjetPrevisionnel::where('program_id', $code)->get();
        foreach ($projets as $projs) {
            foreach ($projs->projets as $key => $proj) {
                $result+=$proj->budget;
            }

        }
        return $result;
    }
}
