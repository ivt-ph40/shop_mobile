<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    protected $table = 'wards';
    protected $fillable = [
    	'name', 'district_id'
    ];
    public function orders()
    {
    	return $this->hasMany('App\Order');
    }
}
