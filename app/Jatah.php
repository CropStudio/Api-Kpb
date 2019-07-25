<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Jatah extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'jumlah', 'id_pupuk', 'id_poktan', 'id_petani'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $table = 'jatah';

    public function scopeGabung($query)
    {
        return $query->leftJoin('pupuk', 'jatah.id_pupuk', '=', 'pupuk.id')
            ->leftJoin('poktan', 'jatah.id_poktan', '=', 'poktan.id')
            ->leftJoin('petani', 'jatah.id_petani', '=', 'petani.id')
            ->select('*', 'pupuk.nama as nama_pupuk', 'poktan.nama as nama_poktan', 'petani.nama as nama_petani', 'jatah.id', 'jatah.id_poktan as id_poktan');
    }
}
