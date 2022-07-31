<?php

namespace App\Policies;

use App\Models\User;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\Models\Chart;

class ChartPolicy
{
	use HandlesAuthorization;

	public function view(User $user, Chart $chart)
	{
		return $user->id==$chart->user_id;
	}

	public function create(User $user)
	{
	}

	public function update(User $user, Chart $chart)
	{
		return $user->id==$chart->user_id;
	}

	public function delete(User $user, Chart $chart)
	{
		return $user->id==$chart->user_id;
	}
}