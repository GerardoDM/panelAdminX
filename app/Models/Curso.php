<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table = 'curso';
    protected $primaryKey = 'clave';
    protected $rememberTokenName = false;
    public $incrementing = false;
    public $timestamps = false;


    public function usuario()
    {
        return $this->belongsTo('App\Usuario', 'foreign_key', 'clave');
    }
}
