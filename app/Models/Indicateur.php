<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicateur extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function activite()
    {
        return $this->belongsTo(Activite::class, 'activite_id');
    }
}