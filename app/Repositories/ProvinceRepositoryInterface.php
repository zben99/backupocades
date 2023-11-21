<?php

namespace App\Repositories;

interface ProvinceRepositoryInterface
{

    /**
     * Obtenir une province
     *
     * @param string
     */
    public function get($id);


    /**
     * Obtenir toutes les provinces
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
     * Modifier une province
     * @param string
     * @param array
     */
    public function update($id, array $data);

    /**
     * Supprimer une province
     *
     * @param string
     */
    public function delete($id);
}
