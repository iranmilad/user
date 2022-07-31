<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

 class SubscribeAccessibility extends Model
{

	protected $fillable=["id","subscribe_id","reference_id","reference_type","refresh_time"];

	public function subscribe(){
		return $this->belongsTo(Subscribe::class,"subscribe_id");
	}

}