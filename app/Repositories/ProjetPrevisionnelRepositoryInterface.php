<?php

namespace App\Repositories;

interface ProjetPrevisionnelRepositoryInterface
{

    /**
     * Obtenir une projetPrevisionnel
     *
     * @param string
     */
    public function get($id);


    /**
     * Obtenir toutes les projetPrevisionnels
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
     * Modifier une projetPrevisionnel
     * @param string
     * @param array
     */
    public function update($id, array $data);

    /**
     * Restaurer un document
     *
     * @param string
     */
    public function restore($code_document);

    /**
     * Supprimer definitivement un document
     *
     * @param string
     */
    public function forceDelete($code_document);

    /**
     * Obtenir les documents supprimés
     *
     * @return mixed
     */
    public function getDelete();

    /**
     * Supprimer une projetPrevisionnel
     *
     * @param string
     */
    public function delete($id);
}