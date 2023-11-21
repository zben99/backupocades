<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjetPrevisionnel extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [
        'id',
    ];

    public function partenaires()
    {
        return $this->belongsToMany(Partenaire::class, 'projet_previsionnel_partenaires', 'projet_previsionnel_id', 'partenaire_id');
    }

    public function activites()
    {
        return $this->hasMany(ActivitePrevisionnelle::class);
    }

    public function agentSaisie()
    {
        return $this->belongsTo(User::class, 'agent');
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    public function projets()
    {
        return $this->hasMany(Projet::class,'projetprevisionnel_id');
    }


}
