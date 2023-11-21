<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Typepartenaire extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [
        'id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function partenaires()
    {
        return $this->hasMany(Partenaire::class, 'typepartenaire_id');
    }
}