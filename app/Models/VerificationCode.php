<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

 class VerificationCode extends Model
{

	protected $fillable=["gu_id","mobile","code","expire_at","info","used"];
	
}