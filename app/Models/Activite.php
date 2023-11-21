<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Activite
 * @package App\Models
 * @version July 30, 2021, 7:35 am UTC
 *
 * @property \App\Models\ActivitePrevisionnelle $activitePrevisionnelle
 * @property \App\Models\Domaine $domaine
 * @property \App\Models\Paroiss $paroisse
 * @property \Illuminate\Database\Eloquent\Collection $detailFinancements
 * @property string $libelle
 * @property integer $unite_physique
 * @property integer $quantite_realise
 * @property number $cout_total_realisation
 * @property number $contrib_beneficiaire
 * @property integer $bene_d_homme
 * @property integer $bene_d_femme
 * @property integer $activite_previsionnelle_id
 * @property integer $paroisse_id
 * @property integer $domaine_id
 */
class Activite extends Model
{
    use HasFactory, SoftDeletes;

    public $fillable = [
        'libelle',
        'agent',
        'date_realisation',
        'unite_physique',
        'quantite_realise',
        'cout_total_realisation',
        'contrib_beneficiaire',
        'bene_d_homme',
        'bene_d_femme',
        'activite_previsionnelle_id',
        'paroisse_id',
        'observation',
        'type_beneficiaire',
        'domaine_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'libelle' => 'string',
        'observation' => 'string',
        'type_beneficiaire' => 'string',
        'unite_physique' => 'string',
        'quantite_realise' => 'integer',
        'cout_total_realisation' => 'float',
        'contrib_beneficiaire' => 'string',
        'bene_d_homme' => 'integer',
        'bene_d_femme' => 'integer',
        'activite_previsionnelle_id' => 'integer',
        'paroisse_id' => 'integer',
        'domaine_id' => 'integer',
        'date_realisation' => 'date',
        'agent' => 'integer',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function activitePrevisionnelle()
    {
        return $this->belongsTo(\App\Models\ActivitePrevisionnelle::class, 'activite_previsionnelle_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function domaine()
    {
        return $this->belongsTo(\App\Models\Domaine::class, 'domaine_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function paroisse()
    {
        return $this->belongsTo(\App\Models\Paroisse::class, 'paroisse_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     **/
    public function partenaires()
    {
        return $this->belongsToMany(\App\Models\Partenaire::class, 'detail_financements', 'activite_id', 'partenaire_id')->withPivot(["montant", "description"]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function documents()
    {
        return $this->hasMany(\App\Models\Activitedocument::class, 'activite_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function indicateurs()
    {
        return $this->hasMany(\App\Models\Indicateur::class, 'activite_id');
    }

    public function agentSaisie()
    {
        return $this->belongsTo(User::class, 'agent');
    }
}
