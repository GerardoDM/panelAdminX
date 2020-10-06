<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bloque extends Model
{
    protected $table = 'bloque';
    protected $primaryKey = 'clave';
    protected $rememberTokenName = false;
    public $incrementing = false;
    public $timestamps = false;
}
