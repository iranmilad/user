<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

 class Admin extends Authenticatable
{

	protected $fillable=["id","first_name","last_name","mobile","supper_admin","password","active"];
}