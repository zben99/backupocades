<?php

namespace App\Repositories;

interface VillageRepositoryInterface
{

    /**
     * Obtenir une village
     *
     * @param string
     */
    public function get($id);


    /**
     * Obtenir toutes les villages
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
     * Modifier une village
     * @param string
     * @param array
     */
    public function update($id, array $data);

    /**
     * Supprimer une village
     *
     * @param string
     */
    public function delete($id);
}
