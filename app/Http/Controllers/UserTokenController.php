<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserToken\storeUserTokenRequest;
use App\Models\UserToken;

class UserTokenController extends Controller
{

	public function create(storeUserTokenRequest $request)
	{
		$userAuestions=UserToken::query()->updateOrCreate(["user_id"=>auth()->id(),"token"=>$request->input('token')],[
			"user_id"=>auth()->id(),
			"token"=>$request->input('token'),
			"device"=>$request->input('device'),
		]);
		if(request()->wantsJson())
		{
			return $this->responseJson("توکن با موفقیت ایجاد شد",null,201);
		}
		return view("userAuestions.index",compact('userAuestions'));
	}
}