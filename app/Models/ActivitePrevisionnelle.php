<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivitePrevisionnelle extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [
        'id',
    ];

    public function projetPrevisionnel()
    {
        return $this->belongsTo(ProjetPrevisionnel::class, 'projet_previsionnel_id');
    }

    /*public function commune()
    {
        return $this->belongsTo(Commune::class);
    }*/

    public function activites()
    {
        return $this->hasMany(\App\Models\Activite::class, 'activite_previsionnelle_id');
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
    public function region()
    {
        return $this->belongsTo(\App\Models\Region::class, 'region_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function paroisses()
    {
        return $this->belongsToMany(\App\Models\Paroisse::class, 'paroisse_prevesionnelle','activite_previsionnelle_id', 'paroisse_id')->withPivot(['paroisse_id']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     **/
    public function partenaires()
    {
        return $this->belongsToMany(\App\Models\Partenaire::class, 'financement_prevesionnelle', 'activite_previsionnelle_id', 'partenaire_id')->withPivot(["montant", "description",'partenaire_id']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function villages()
    {
        return $this->belongsToMany(\App\Models\Village::class,'village_prevesionnelle', 'activite_previsionnelle_id','village_id')->withPivot(['village_id']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function communes()
    {
        return $this->belongsToMany(\App\Models\Commune::class,'commune_prevesionnelle', 'activite_previsionnelle_id','commune_id')->withPivot(['commune_id']);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function indicateurs()
    {
        return $this->hasMany(\App\Models\Indicateurprev::class, 'activite_previsionnelle_id');
    }

    public function agentSaisie()
    {
        return $this->belongsTo(User::class, 'agent');
    }

    public function objectif_specifiques()
    {
        return $this->belongsToMany(ObjectifSpecifique::class,'activite_prev_objectifs','activite_prev_id');
    }
    // return $this->belongsToMany(Diplome::class, DiplomeChercheur::class,'matricule_chercheur','id','matricule')->withPivot(['date_obtention','observation']);
}
