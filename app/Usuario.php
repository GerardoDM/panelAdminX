<?php

namespace App;


use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
//use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth as ModelAuth;

class Usuario extends Model implements AuthenticatableContract
{
    
    protected $table = 'usuarios';
    protected $primaryKey = 'clave';
    protected $rememberTokenName = false;

    public $timestamps = false;
    //protected $pass = 'pass';

    public function setAttribute($key, $value)
  {
    $isRememberTokenAttribute = $key == $this->getRememberTokenName();
    if (!$isRememberTokenAttribute)
    {
      parent::setAttribute($key, $value);
    }
  }


    protected $fillable = [
        'nombre','apepat', 'apemat', 'mail', 'nickname', 'pass', 'status', 'cve_tipousuario'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    

    public function getTable()
    {
        if (! isset($this->table)) {
            return str_replace(
                '\\', '', Str::snake(Str::plural(class_basename($this)))
            );
        }
 
        return $this->table;
    }


    //ADD OF TODAY

    public function getAuthPassword()
    {
     return $this->pass;
    }


    //IMPLEMENTATION AUTHENTICATABLE

        /**
     * {@inheritDoc}
     * @see \Illuminate\Contracts\Auth\Authenticatable::getAuthIdentifierName()
     */
    public function getAuthIdentifierName()
    {
        return "mail";
    }
    
    /**
     * {@inheritDoc}
     * @see \Illuminate\Contracts\Auth\Authenticatable::getAuthIdentifier()
     */
    public function getAuthIdentifier()
    {
        return $this->{$this->getAuthIdentifierName()};
    }
    
    
    /**
     * {@inheritDoc}
     * @see \Illuminate\Contracts\Auth\Authenticatable::getRememberToken()
     */
    public function getRememberToken()
    {
        if (! empty($this->getRememberTokenName())) {
        return $this->{$this->getRememberTokenName()};
        }
    }
    
    /**
     * {@inheritDoc}
     * @see \Illuminate\Contracts\Auth\Authenticatable::setRememberToken()
     */
    public function setRememberToken($value)
    {
        // if (! empty($this->getRememberTokenName())) {
        // $this->{$this->getRememberTokenName()} = $value;
        // }
        return false;
    }
    
    /**
     * {@inheritDoc}
     * @see \Illuminate\Contracts\Auth\Authenticatable::getRememberTokenName()
     */
    public function getRememberTokenName()
    {
        return $this->rememberTokenName;
    }
}