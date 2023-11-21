<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicateurprev extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function activiteprev()
    {
        return $this->belongsTo(ActivitePrevisionnelle::class, 'activite_previsionnelle_id');
    }
}