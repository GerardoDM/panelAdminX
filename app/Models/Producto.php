<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'producto';
    protected $primaryKey = 'clave';
    protected $rememberTokenName = false;
    public $incrementing = false;
    public $timestamps = false;

    public function proyectos()
    {
        return $this->belongsToMany('App\Models\Proyecto','producto-proyecto', 'clave', 'clave')->using(Pivot::class);
    }
}
