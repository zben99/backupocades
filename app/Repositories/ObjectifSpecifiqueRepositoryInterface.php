<?php

namespace App\Repositories;

interface ObjectifSpecifiqueRepositoryInterface
{

    /**
     * Obtenir une objectifSpecifique
     *
     * @param string
     */
    public function get($id);


    /**
     * Obtenir toutes les objectifSpecifiques
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
     * Modifier une objectifSpecifique
     * @param string
     * @param array
     */
    public function update($id, array $data);

    /**
     * Supprimer une objectifSpecifique
     *
     * @param string
     */
    public function delete($id);
}
