<?php

namespace App\Repositories;

interface SecteurRepositoryInterface
{

    /**
     * Obtenir une secteur
     *
     * @param string
     */
    public function get($id);


    /**
     * Obtenir toutes les secteurs
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
     * Modifier une secteur
     * @param string
     * @param array
     */
    public function update($id, array $data);

    /**
     * Supprimer une secteur
     *
     * @param string
     */
    public function delete($id);
}
