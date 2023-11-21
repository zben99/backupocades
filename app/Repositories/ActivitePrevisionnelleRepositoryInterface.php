<?php

namespace App\Repositories;

interface ActivitePrevisionnelleRepositoryInterface
{

    /**
     * Obtenir une activitePrevisionnelle
     *
     * @param string
     */
    public function get($id);


    /**
     * Obtenir toutes les activitePrevisionnelles
     * @return mixed
     */
    public function all();

    /**
     * Obtenir toutes les activitePrevisionnelles ayant des activites
     * @return mixed
     */
    public function allActivites();

    /**
     * Ajouter un nouveau
     *
     * @param array
     */
    public function add(array $data);

    /**
     * Modifier une activitePrevisionnelle
     * @param string
     * @param array
     */
    public function update($id, array $data);

    /**
     * Supprimer une activitePrevisionnelle
     *
     * @param string
     */
    public function delete($id);
}
