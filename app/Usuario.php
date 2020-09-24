<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    //
    protected $table = 'usuarios';
    protected $primaryKey = 'clave';
    public $timestamps = false;


    public function getTable()
    {
        if (! isset($this->table)) {
            return str_replace(
                '\\', '', Str::snake(Str::plural(class_basename($this)))
            );
        }
 
        return $this->table;
    }
}