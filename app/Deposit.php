<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'deposits';

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
    protected $fillable = ['nombre', 'direccion'];


    public function articles()
    {
        return $this->belongsToMany('App\Article','article_deposit')
                    ->withPivot('stock')
                    ->withTimestamps();

    }


    public function setNombreAttribute($value){

        $this->attributes['nombre']= strtoupper($value);

    }

    public function deliverynotes(){

        $this->belongsTo('App\Deposit');
    }

}
