<?php

namespace App\Policies;

use App\Models\User;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\Models\UserSubscribe;

class UserSubscribePolicy
{
	use HandlesAuthorization;

	public function view(User $user, UserSubscribe $usersubscribe)
	{
		return $user->id==$usersubscribe->user_id;
	}

	public function create(User $user)
	{
	}

	public function update(User $user, UserSubscribe $usersubscribe)
	{
		return $user->id==$usersubscribe->user_id;
	}

	public function delete(User $user, UserSubscribe $usersubscribe)
	{
		return $user->id==$usersubscribe->user_id;
	}
}