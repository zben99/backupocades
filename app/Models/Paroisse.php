<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paroisse extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [
        'id',
    ];

    public function commune()
    {
        return $this->belongsTo(Commune::class);
    }

    public function villages()
    {
        return $this->hasMany(Village::class, 'paroisse_id',);
    }
}