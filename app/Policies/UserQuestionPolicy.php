<?php

namespace App\Policies;

use App\Models\User;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\Models\UserQuestion;

class UserQuestionPolicy
{
	use HandlesAuthorization;

	public function view(User $user, UserQuestion $userquestion)
	{
		return $user->id==$userquestion->user_id;
	}

	public function create(User $user)
	{
	}

	public function update(User $user, UserQuestion $userquestion)
	{
		return $user->id==$userquestion->user_id;
	}

	public function delete(User $user, UserQuestion $userquestion)
	{
		return $user->id==$userquestion->user_id;
	}
}