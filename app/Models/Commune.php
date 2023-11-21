<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commune extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [
        'id',
    ];

    public function paroisses()
    {
        return $this->hasMany(Paroisse::class, 'paroisse_id',);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}