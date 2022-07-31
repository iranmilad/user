<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

 class UserNotification extends Model
{

	protected $fillable=["id","user_id","notification_id","seen_at"];
	
	public function user()
	{
		return $this->belongsTo(User::class);
	}
	public function notification()
	{
		return $this->belongsTo(Notification::class);
	}
}