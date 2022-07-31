<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

 class UserSubscribe extends Model
{
	use SoftDeletes;
	protected $fillable=["id","user_id","title","price","payment_gu_id","expire_at"];
	public function user()
	{
		return $this->belongsTo(User::class);
	}
}