<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Petani extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 'nik', 'jenis_kelamin', 'komoditas', 'id_poktan', 'luas_lahan', 'id_user'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
}
