<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

 class UserMemberList extends Model
{

	protected $fillable=["id","user_id","member_list_id"];
	
	public function user()
	{
		return $this->belongsTo(User::class);
	}
	
	public function memberList()
	{
		return $this->belongsTo(MemberList::class);
	}
}