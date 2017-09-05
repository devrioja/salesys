<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'suppliers';

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
    protected $fillable = ['nombre', 'direccion', 'telefono', 'correo'];



    public function setNombreAttribute($value){

        $this->attributes['nombre']= strtoupper($value);

    }
    
    public function deliveryNote(){

        return $this->hasMany('App\DeliveryNote','supplier_id','id');
    }

}
