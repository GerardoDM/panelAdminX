<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{


    
    use Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'clave';
    //protected $rememberTokenName = false;
    public $timestamps = false;
    protected $guarded = ['clave'];
    protected $guard = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre','apepat', 'apemat', 'mail', 'nickname', 'pass', 'status', 'cve_tipousuario'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'pass',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
}
