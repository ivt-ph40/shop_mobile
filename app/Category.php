<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
    	'name', 'description', 'parent_id', 'status'
    ];
    public function products()
    {
    	return $this->hasMany('App\Product');
    }
    public function subcategory()
    {
    	return $this->hasMany('App\Category', 'parent_id');
    }
}
