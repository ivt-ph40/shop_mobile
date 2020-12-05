<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = [
    	'name', 'display_name'
    ];
    public function permissions()
    {
    	return $this->belongsToMany('App\Permission');
    }
}
