<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';
    protected $fillable = [
    	'name', 'province_id'
    ];
    public function orders()
    {
    	return $this->hasMany('App\Order');
    }
}
