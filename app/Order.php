<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
    	'user_id', 'fullname', 'email', 'street', 'province_id', 'district_id', 'ward_id', 'status_id', 'phone', 'created_at'
    ];
    public function province()
    {
    	return $this->belongsTo('App\Province');
    }
    public function district()
    {
    	return $this->belongsTo('App\District');
    }
    public function ward()
    {
    	return $this->belongsTo('App\Ward');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function order_status()
    {
        return $this->belongsTo('App\Order_status', 'status_id', 'id');
    }
}
