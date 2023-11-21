<?php

namespace App\Repositories;

interface ConfigRepositoryInterface
{

    /**
     * Obtenir une config
     *
     * @param string
     */
    public function get();

    /**
     * Modifier un config
     * @param string
     * @param array
     */
    public function update($id, array $data);
}
