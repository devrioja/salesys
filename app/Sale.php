<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sales';

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
    protected $fillable = ['fecha', 'customer_id', 'costoTotal', 'descripcion','numero_factura','descuento'];

    public function articles(){

        return $this->belongsToMany('App\Article','article_sale')
                    ->withPivot('cantidad_vendida','precio')
                    ->withTimestamps();

    }

    public function customers(){

        return $this->hasOne('App\Customer');
        
    }
}
