<?php

namespace App\Repositories;

interface IndicateurRepositoryInterface
{

    /**
     * Obtenir une indicateur
     *
     * @param string
     */
    public function get($id);


    /**
     * Obtenir toutes les indicateurs
     * @return mixed
     */
    public function all();

    /**
     * Ajouter un nouveau
     *
     * @param array
     */
    public function add(array $data);

    /**
     * Modifier une indicateur
     * @param string
     * @param array
     */
    public function update($id, array $data);

    /**
     * Supprimer une indicateur
     *
     * @param string
     */
    public function delete($id);
}
