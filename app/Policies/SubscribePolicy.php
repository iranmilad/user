<?php

namespace App\Policies;

use App\Models\User;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\Models\Subscribe;

class SubscribePolicy
{
	use HandlesAuthorization;

	public function view(User $user, Subscribe $subscribe)
	{
		return $user->id==$subscribe->user_id;
	}

	public function create(User $user)
	{
	}

	public function update(User $user, Subscribe $subscribe)
	{
		return $user->id==$subscribe->user_id;
	}

	public function delete(User $user, Subscribe $subscribe)
	{
		return $user->id==$subscribe->user_id;
	}
}