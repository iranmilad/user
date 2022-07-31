<?php

namespace App\Policies;

use App\Models\User;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\Models\UserNotification;

class UserNotificationPolicy
{
	use HandlesAuthorization;

	public function view(User $user, UserNotification $usernotification)
	{
		return $user->id==$usernotification->user_id;
	}

	public function create(User $user)
	{
	}

	public function update(User $user, UserNotification $usernotification)
	{
		return $user->id==$usernotification->user_id;
	}

	public function delete(User $user, UserNotification $usernotification)
	{
		return $user->id==$usernotification->user_id;
	}

}