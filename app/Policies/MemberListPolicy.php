<?php

namespace App\Policies;

use App\Models\User;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\Models\MemberList;

class MemberListPolicy
{
	use HandlesAuthorization;

	public function view(User $user, MemberList $memberlist)
	{
		return $user->id==$memberlist->user_id;
	}

	public function create(User $user)
	{
	}

	public function update(User $user, MemberList $memberlist)
	{
		return $user->id==$memberlist->user_id;
	}

	public function delete(User $user, MemberList $memberlist)
	{
		return $user->id==$memberlist->user_id;
	}
}