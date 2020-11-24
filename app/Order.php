<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
    	'user_id', 'fullname', 'email', 'street', 'province_id', 'district_id', 'ward_id', 'status_id', 'phone'
    ];
}
