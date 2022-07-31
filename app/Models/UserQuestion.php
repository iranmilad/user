<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

 class UserQuestion extends Model
{

	protected $fillable=["id","user_id","type","title","question","answer","answerd_at","answerd_by"];
	
	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function responder()
	{
		return $this->belongsTo(Admin::class,'answerd_by');
	}
}