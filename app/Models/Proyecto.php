<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $table = 'proyecto';
    protected $primaryKey = 'clave';
    protected $rememberTokenName = false;
    public $incrementing = false;


    public $timestamps = false;
}
