<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sku', 'description', 'price','quantity'
    ];

    public function getPriceAttribute($value){
        $num = $value/100;
        return 'R$ ' . number_format($num, 2, ',', '.');
    }

    public function setPriceAttribute($value){
        $value = str_replace('R$', '', $value);
        $value = str_replace('.', '', $value);
        $value = str_replace(',', '.', $value);
        $num = $value*100;
        $this->attributes['price'] = $num;
    }
}
