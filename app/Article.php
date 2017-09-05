<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'articles';

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
    protected $fillable = ['nombre', 'descripcion', 'category_id', 'brand_id', 'stockMin', 'stockMax', 'precio'];

    
    
    public function category(){

    return $this->belongsTo('App\Category');
    }

    public function deliveryNotes(){

        return $this->belongsToMany('App\DeliveryNote','article_deliverynote');

    }

    public function brand(){

        return $this->belongsTo('App\Brand');

    }

    public function deposits()
    {
        return $this->belongsToMany('App\Deposit','article_deposit');
    }

    /**
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param string $table
     */
    



    public function sales(){

        return $this->belongsToMany('App\Sale','article_sale');

    }


    public function setNombreAttribute($value){

        $this->attributes['nombre']= strtoupper($value);

    }
}
