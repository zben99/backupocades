<?php

namespace App\Repositories;

interface RegionRepositoryInterface
{

    /**
     * Obtenir une region
     *
     * @param string
     */
    public function get($id);


    /**
     * Obtenir toutes les regions
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
     * Modifier une region
     * @param string
     * @param array
     */
    public function update($id, array $data);

    /**
     * Supprimer une region
     *
     * @param string
     */
    public function delete($id);
}
