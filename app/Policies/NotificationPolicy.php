<?php

namespace App\Policies;

use App\Models\User;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\Models\Notification;

class NotificationPolicy
{
	use HandlesAuthorization;

	public function view(User $user, Notification $notification)
	{
		return $user->id==$notification->user_id;
	}

	public function create(User $user)
	{
	}

	public function update(User $user, Notification $notification)
	{
		return $user->id==$notification->user_id;
	}

	public function delete(User $user, Notification $notification)
	{
		return $user->id==$notification->user_id;
	}
	
	public function seen(User $user, Notification $notification)
	{
		return $notification->type==1 ||
		   $notification->users()->where('user_id',$user->id)->count() > 0;
	}
}