<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserSubscribe;
use App\Http\Resources\UserSubscribe\UserSubscribeCollection;
use App\Http\Requests\UserSubscribe\storeUserSubscribeRequest;
use App\Http\Requests\UserSubscribe\updateUserSubscribeRequest;
use App\Models\Subscribe;
use Illuminate\Http\Request;
use App\Traits\Paginate;

class UserSubscribeController extends Controller
{
	use Paginate;
	public function index(Request $request)
	{
		if($request->wantsJson())
		{
            $query = UserSubscribe::query()->with('user:id,first_name,last_name');
            $userSubscribes = $this->paginate($query,["id","user_id","title","price","payment_gu_id","expire_at","created_at"]);
            return response()->json(new UserSubscribeCollection($userSubscribes));
		}
		return view("admin.userSubscribes.index");
	}

	public function create()
	{
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return view("admin.userSubscribes.create");
	}

	public function store(storeUserSubscribeRequest $request)
	{
		$subscribe=Subscribe::query()->findOrFail($request->input("subscribe_id"));
		$userIds=$request->input("user_id");

		foreach($userIds as $userId){
			UserSubscribe::query()->create([
			"user_id"=>$userId,
			"title"=>$subscribe->title,
			"price"=>$subscribe->price,
			"expire_at"=>now()->addDays($subscribe->period),
			]);
		}		
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return redirect()->route("userSubscribes.index");
	}

	public function edit($id)
	{
		$userSubscribe = UserSubscribe::query()->findOrFail($id);
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return view("admin.userSubscribes.edit",compact('userSubscribe'));
	}

	public function update(updateUserSubscribeRequest $request,$id)
	{
		$userSubscribe = UserSubscribe::query()->findOrFail($id);
		$userSubscribe->update($request->all());
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return redirect()->route("userSubscribes.index");
	}

	public function destroy($id)
	{
		$userSubscribe = UserSubscribe::query()->findOrFail($id);
		$userSubscribe->delete();
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return redirect()->route("userSubscribes.index");
	}

	public function show($id)
	{
		$userSubscribe = UserSubscribe::query()->findOrFail($id);
		if(request()->wantsJson())
		{
			return response()->json($userSubscribe);
		}
		return view("admin.userSubscribes.info",compact('userSubscribe'));
	}
}