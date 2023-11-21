<?php

namespace App\Repositories;

interface HistoriqueRepositoryInterface
{

    /**
     * Ajouter un historique
     *
     * @param array
     */
    public function add($projet, $motif);


    /**
     * Recuperer tous les historiques
     *
     * @return mixed
     */
    public function all();

    /**
     * Supprimer un historique
     *
     * @param string
     */
    public function delete($code);

    /**
     * Supprimer tous historiques
     *
     *
     */
    public function vider();
}