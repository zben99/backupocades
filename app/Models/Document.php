<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongTo
     **/
    public function projet()
    {
        return $this->belongsTo(\App\Models\Projet::class, 'projet_id');
    }
}
