<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'product_id', 'price','quantity','date','type'
    ];

    public function product(){
        return  $this->hasOne('App\Product','product_id','id');
   }
}
