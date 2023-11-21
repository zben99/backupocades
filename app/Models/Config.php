<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Config extends Model
{
    use HasFactory;

    public $fillable = [
        'nom',
        'logo',
        'email',
        'telephone',
        'site',
        'adresse'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nom'=> 'string',
        'logo'=> 'string',
        'email'=> 'string',
        'telephone'=> 'string',
        'site'=> 'string',
        'adresse'=> 'string'
    ];
}