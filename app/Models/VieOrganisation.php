<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VieOrganisation extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [
        'id',
    ];

    public function fichiers()
    {
        return $this->hasMany(VieOrganisationDocument::class);
    }

    public function type()
    {
        return $this->belongsTo(TypeDocument::class,'type_document_id','id');
    }

}
