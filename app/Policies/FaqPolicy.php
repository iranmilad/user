<?php

namespace App\Policies;

use App\Models\User;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\Models\Faq;

class FaqPolicy
{
	use HandlesAuthorization;

	public function view(User $user, Faq $faq)
	{
		return $user->id==$faq->user_id;
	}

	public function create(User $user)
	{
	}

	public function update(User $user, Faq $faq)
	{
		return $user->id==$faq->user_id;
	}

	public function delete(User $user, Faq $faq)
	{
		return $user->id==$faq->user_id;
	}
}