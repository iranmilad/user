<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

 class Payment extends Model
{
	use SoftDeletes;
	protected $fillable=["id","gu_id","user_id","reference_id","ref_id","amount","state","type"];
	
	public function user()
	{
		return $this->belongsTo(User::class);
	}
}