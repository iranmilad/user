<?php

namespace App\Policies;

use App\Models\User;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\Models\Admin;

class AdminPolicy
{
	use HandlesAuthorization;

	public function view(User $user, Admin $admin)
	{
		return $user->id==$admin->user_id;
	}

	public function create(User $user)
	{
	}

	public function update(User $user, Admin $admin)
	{
		return $user->id==$admin->user_id;
	}

	public function delete(User $user, Admin $admin)
	{
		return $user->id==$admin->user_id;
	}
}