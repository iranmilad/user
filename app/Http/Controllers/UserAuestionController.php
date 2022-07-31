<?php

namespace App\Http\Controllers;

use App\Models\UserQuestion;
use App\Http\Requests\UserQuestion\storeUserAuestionRequest;
use App\Http\Requests\UserQuestion\updateUserAuestionRequest;

class UserAuestionController extends Controller
{
	public function index()
	{
		$userAuestions=UserQuestion::query()->paginate(15,["id","user_id","type","title","question","answerd_at","answerd_by"]);
		if(request()->wantsJson())
		{
			return response()->json($userAuestions);
		}
		return view("userAuestions.index",compact('userAuestions'));
	}
}