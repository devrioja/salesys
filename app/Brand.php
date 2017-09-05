<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'brands';

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
    protected $fillable = ['nombre', 'descripcion'];

   public function articles(){

       return $this->hasMany('App\Article','brand_id','id');

   }

    public function setNombreAttribute($value){

        $this->attributes['nombre']= strtoupper($value);

    }

}
