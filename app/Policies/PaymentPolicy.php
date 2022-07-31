<?php

namespace App\Policies;

use App\Models\User;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\Models\Payment;

class PaymentPolicy
{
	use HandlesAuthorization;

	public function view(User $user, Payment $payment)
	{
		return $user->id==$payment->user_id;
	}

	public function create(User $user)
	{
	}

	public function update(User $user, Payment $payment)
	{
		return $user->id==$payment->user_id;
	}

	public function delete(User $user, Payment $payment)
	{
		return $user->id==$payment->user_id;
	}
}