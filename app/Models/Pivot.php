<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pivot extends Model
{
    public $incrementing = true;
    public $timestamps = false;
    protected $primaryKey = 'clave';
    protected $table = 'producto-proyecto';

    public function productos()
    {
        return $this->belongsToMany('App\Models\Producto');
    }

    public function proyectos()
    {
        return $this->belongsToMany('App\Models\Proyecto');
    }


}