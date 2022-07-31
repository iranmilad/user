<?php

namespace App\Http\Controllers;

use App\Models\UserSubscribe;
use App\Http\Requests\UserSubscribe\storeUserSubscribeRequest;
use App\Http\Requests\UserSubscribe\updateUserSubscribeRequest;

class UserSubscribeController extends Controller
{
	public function index()
	{
		$userSubscribes=UserSubscribe::query()->paginate(15,["id","user_id","title","price","payment_gu_id","expire_at"]);
		if(request()->wantsJson())
		{
			return response()->json($userSubscribes);
		}
		return view("userSubscribes.index",compact('userSubscribes'));
	}
}