<?php

namespace App\Repositories;

interface TypeDocumentRepositoryInterface
{

    /**
     * Obtenir une typePartenaire
     *
     * @param string
     */
    public function get($id);


    /**
     * Obtenir toutes les typePartenaires
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
     * Modifier une typePartenaire
     * @param string
     * @param array
     */
    public function update($id, array $data);

    /**
     * Supprimer une typePartenaire
     *
     * @param string
     */
    public function delete($id);
}
