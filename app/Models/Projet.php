<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Projet
 * @package App\Models
 * @version July 30, 2021, 7:45 am UTC
 *
 * @property \App\Models\Document $document
 * @property \App\Models\Projetprevisionnel $projetprevisionnel
 * @property \Illuminate\Database\Eloquent\Collection $projetPartenaires
 * @property \Illuminate\Database\Eloquent\Collection $projetSecteurs
 * @property string $libelle
 * @property string $description
 * @property number $budget
 * @property number $montantCharge
 * @property number $montantEquipement
 * @property number $totalRessFinanciere
 * @property string $chefProjet
 * @property string $debut
 * @property string $fin
 * @property number $depenseBeneficiaire
 * @property number $montantTotalDepense
 * @property integer $projetprevisionnel_id
 */
class Projet extends Model
{
    use HasFactory, SoftDeletes;

    public $fillable = [
        'libelle',
        'description',
        'agent',
        'budget',
        'montantCharge',
        'montantEquipement',
        'totalRessFinanciere',
        'chefProjet',
        'debut',
        'fin',
        'depenseBeneficiaire',
        'montantTotalDepense',
        'projetprevisionnel_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'libelle' => 'string',
        'description' => 'string',
        'budget' => 'decimal:2',
        'montantCharge' => 'decimal:2',
        'montantEquipement' => 'decimal:2',
        'totalRessFinanciere' => 'decimal:2',
        'chefProjet' => 'string',
        'debut' => 'date',
        'fin' => 'date',
        'depenseBeneficiaire' => 'decimal:2',
        'montantTotalDepense' => 'decimal:2',
        'projetprevisionnel_id' => 'integer',
        'agent' => 'integer',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function documents()
    {
        return $this->hasMany(\App\Models\Document::class, 'projet_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function projetprevisionnel()
    {
        return $this->belongsTo(\App\Models\ProjetPrevisionnel::class, 'projetprevisionnel_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     **/
    public function partenaires()
    {
        return $this->belongsToMany(\App\Models\Partenaire::class, 'projet_partenaire')->withPivot(["montant", "description"]);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     **/
    public function secteurs()
    {
        return $this->belongsToMany(\App\Models\Secteur::class, 'projet_secteur');
    }

    public function agentSaisie()
    {
        return $this->belongsTo(User::class, 'agent');
    }
}
