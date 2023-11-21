<?php

namespace App\Repositories;

interface ParoisseRepositoryInterface
{

    /**
     * Obtenir une paroisse
     *
     * @param string
     */
    public function get($id);


    /**
     * Obtenir toutes les paroisses
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
     * Modifier une paroisse
     * @param string
     * @param array
     */
    public function update($id, array $data);

    /**
     * Supprimer une paroisse
     *
     * @param string
     */
    public function delete($id);
}
