<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_status extends Model
{
    protected $table = 'order_statuses';
    protected $fillable = [
    	'name'
    ];
    public function orders()
    {
    	return $this->hasMany('App\Order', 'status_id', 'id');
    }
}
