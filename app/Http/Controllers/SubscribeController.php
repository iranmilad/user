<?php

namespace App\Http\Controllers;

use App\Models\Subscribe;

class SubscribeController extends Controller
{
	public function index()
	{
		$subscribes=Subscribe::query()->paginate(15,["id","title","description","price","period"]);
		if(request()->wantsJson())
		{
			return response()->json($subscribes);
		}
		return view("subscribes.index",compact('subscribes'));
	}
}