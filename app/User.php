<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 'nik', 'no_hp', 'role', 'tanggal_lahir', 'password', 'ktp', 'kartukeluarga', 'token', 'poto_profile'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
    public function anaks()
    {
        return $this->hasMany('App\Anak');
    }
    public function scopeGabung($query)
    {
        return $query->leftJoin('petani', 'petani.id_user', '=', 'users.id')
            ->leftJoin('anak', 'users.id', '=', 'anak.id_user')
            ->leftJoin('poktan', 'petani.id_poktan', '=', 'poktan.id')
            ->select('*', 'users.nik as nik', 'poktan.nama as nama_poktan', 'users.id', 'users.nama as nama', 'anak.nama as nama_anak', 'anak.tanggal_lahir as tanggal_lahir_anak', 'anak.jenis_kelamin as jenis_kelamin_anak');
    }
}
