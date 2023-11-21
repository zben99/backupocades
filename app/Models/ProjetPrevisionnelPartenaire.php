<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjetPrevisionnelPartenaire extends Model
{
    use HasFactory;

    public $table = 'projet_previsionnel_partenaires';

    protected $guarded = [
        'id',
    ];
}