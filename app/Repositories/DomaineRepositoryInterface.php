<?php

namespace App\Repositories;

interface DomaineRepositoryInterface
{

    /**
     * Obtenir une domaine
     *
     * @param string
     */
    public function get($id);


    /**
     * Obtenir tous les domaines
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
     * Modifier un domaine
     * @param string
     * @param array
     */
    public function update($id, array $data);

    /**
     * Supprimer un domaine
     *
     * @param string
     */
    public function delete($id);
}
