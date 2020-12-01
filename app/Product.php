<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
    	'name', 'category_id', 'brand_id', 'description', 'content', 'quantity', 'sold', 'image', 'price', 'status'
    ];
    public function category()
    {
    	return $this->belongsTo('App\Category');
    }
    public function brand()
    {
    	return $this->belongsTo('App\Brand');
    }
    public function orderDetails()
    {
        return $this->hasMany('App\OrderDetail');
    }
    public function images()
    {
        return $this->hasMany('App\Image');
    }
}
