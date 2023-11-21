<?php

namespace App\Repositories;

interface CommuneRepositoryInterface
{

    /**
     * Obtenir une commune
     *
     * @param string
     */
    public function get($id);


    /**
     * Obtenir toutes les communes
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
     * Modifier une commune
     * @param string
     * @param array
     */
    public function update($id, array $data);

    /**
     * Supprimer une commune
     *
     * @param string
     */
    public function delete($id);
}
