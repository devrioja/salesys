<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckingAccount extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'checking_accounts';

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
    protected $fillable = ['fecha_alta', 'fecha_vencimiento', 'customer_id', 'balance', 'descripcion'];

    public function customer(){

        $this->belongsTo('App\Customer');
    }
}
