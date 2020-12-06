<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PivotProductoCurso extends Model
{
    

    public $incrementing = false;
    public $timestamps = false;
    protected $primaryKey = null;
    protected $table = 'producto_curso';

    

    protected $fillable = ['cve_curso', 'cve_producto'];


}
