<?php

namespace App\Repositories;

interface ProgramRepositoryInterface
{

    /**
     * Obtenir une program
     *
     * @param string
     */
    public function get($id);


    /**
     * Obtenir tous les programs
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
     * Modifier un program
     * @param string
     * @param array
     */
    public function update($id, array $data);

    /**
     * Supprimer un program
     *
     * @param string
     */
    public function delete($id);
}
