<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

 class Notification extends Model
{

	protected $fillable=["id","title","text","type"];

	public function  users(){
		return $this->hasMany(UserNotification::class,'notification_id','id');
	}
}