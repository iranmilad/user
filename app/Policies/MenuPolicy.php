<?php

namespace App\Policies;

use App\Models\User;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\Models\Menu;

class MenuPolicy
{
	use HandlesAuthorization;

	public function view(User $user, Menu $menu)
	{
		return $user->id==$menu->user_id;
	}

	public function create(User $user)
	{
	}

	public function update(User $user, Menu $menu)
	{
		return $user->id==$menu->user_id;
	}

	public function delete(User $user, Menu $menu)
	{
		return $user->id==$menu->user_id;
	}
}