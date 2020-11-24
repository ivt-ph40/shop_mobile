<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $table = 'comments';
    protected $fillable = [
    	'fullname', 'user_id', 'product_id', 'content', 'parent_id'
    ];
}
