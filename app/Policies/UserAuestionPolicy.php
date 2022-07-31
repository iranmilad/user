<?php

namespace App\Policies;

use App\Models\User;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\Models\UserQuestion;

class UserAuestionPolicy
{
	use HandlesAuthorization;

	public function view(User $user, UserQuestion $userauestion)
	{
		return $user->id==$userauestion->user_id;
	}

	public function create(User $user)
	{
	}

	public function update(User $user, UserQuestion $userauestion)
	{
		return $user->id==$userauestion->user_id;
	}

	public function delete(User $user, UserQuestion $userauestion)
	{
		return $user->id==$userauestion->user_id;
	}
}