<?php

namespace App\Repositories;

interface PartenaireRepositoryInterface
{

    /**
     * Obtenir une partenaire
     *
     * @param string
     */
    public function get($id);


    /**
     * Obtenir toutes les partenaires
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
     * Modifier une partenaire
     * @param string
     * @param array
     */
    public function update($id, array $data);

    /**
     * Supprimer une partenaire
     *
     * @param string
     */
    public function delete($id);
}
