<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission_Role extends Model
{
    protected $table = 'permission_role';
    protected $fillable = [
    	'permission_id', 'role_id'
    ];
}
