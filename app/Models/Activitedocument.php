<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activitedocument extends Model
{
    use HasFactory;

    public $table = 'document_activites';

    protected $guarded = [
        'id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongTo
     **/
    public function activite()
    {
        return $this->belongsTo(\App\Models\Activite::class, 'activite_id');
    }
}
