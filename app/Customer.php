<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customers';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre', 'apellido', 'documento', 'razon_social','telefono', 'correo', 'direccion','cuit'];



    public function setNombreAttribute($value){

        $this->attributes['nombre']= strtoupper($value);

    }

    public function setApellidoAttribute($value){

        $this->attributes['apellido']= strtoupper($value);

    }

    public function setRazonSocialAttribute($value){

        $this->attributes['razon_social']= strtoupper($value);

    }

}
