<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

 class UserToken extends Model
{

	protected $fillable=["id","user_id","token",'device'];
	
	public function user()
	{
		return $this->belongsTo(User::class);
	}
}