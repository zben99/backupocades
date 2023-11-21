<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'name',
        'forname',
        'code_dir',
        'owner',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function roles(){
        //Crer la relation entre l'user et les roles
        return $this->belongsToMany('App\Models\Role');
    }

    /**
     * Tester si l'utilisateur possède ou non le droit admin
     * Return Boolean
     */
    public function isAdmin(){

        return $this->roles()->where('name','admin')->first();
    }

    /**
     * Tester si l'utilisateur possède ou non ces differents roles
     * Return Boolean
     */
    public function hasAnyRole(array $roles){

        return $this->roles()->whereIn('name', $roles)->first();
    }

}
