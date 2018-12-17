<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnitMeasure extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */

    protected $table = 'unit_measures';

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

        return $this->hasMany('App\Article','unit_measure_id','id');

    }
}
