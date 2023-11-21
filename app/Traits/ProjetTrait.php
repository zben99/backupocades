<?php

namespace App\Traits;

use App\Repositories\HistoriqueRepositoryInterface;

/**
 *
 */
trait ProjetTrait
{

    protected $historique;

    public function __construct(HistoriqueRepositoryInterface $historique)
    {
        $this->historique = $historique;
    }

    public function recordProjetOperation($projet, $motif)
    {
        $this->historique->add($projet, $motif);
    }
}