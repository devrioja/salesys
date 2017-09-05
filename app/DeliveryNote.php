<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class DeliveryNote extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'delivery_notes';

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
    protected $fillable = ['fecha', 'supplier_id', 'descripcion','numero_remito','estado','deposit_id'];



    public function articles(){

        return $this->belongsToMany('App\Article','article_deliverynote')
            ->withPivot('cantidad_ingresada')
            ->withTimestamps();

    }

    public function supplier(){

        $this->hasOne('App\Supplier');

    }

    public function deposits(){

        $this->hasOne('App\Deposit');
    }


}
