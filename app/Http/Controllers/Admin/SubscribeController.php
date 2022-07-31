<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subscribe;
use App\Http\Resources\Subscribe\SubscribeCollection;
use App\Http\Requests\Subscribe\storeSubscribeRequest;
use App\Http\Requests\Subscribe\updateSubscribeRequest;
use Illuminate\Http\Request;
use App\Traits\Paginate;

class SubscribeController extends Controller
{
use Paginate;
	public function index(Request $request)
	{
		if($request->wantsJson())
		{
            $query = Subscribe::query();
            $subscribes = $this->paginate($query,["id","title","description","price","period","created_at"]);
            return response()->json(new SubscribeCollection($subscribes));
		}
		return view("admin.subscribes.index");
	}

	public function create()
	{
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return view("admin.subscribes.create");
	}

	public function store(storeSubscribeRequest $request)
	{
		Subscribe::query()->create($request->all());
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return redirect()->route("subscribes.index");
	}

	public function edit($id)
	{
		$subscribe = Subscribe::query()->findOrFail($id);
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return view("admin.subscribes.edit",compact('subscribe'));
	}

	public function update(updateSubscribeRequest $request,$id)
	{
		$subscribe = Subscribe::query()->findOrFail($id);
		$subscribe->update($request->all());
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return redirect()->route("subscribes.index");
	}

	public function destroy($id)
	{
		$subscribe = Subscribe::query()->findOrFail($id);
		$subscribe->delete();
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return redirect()->route("subscribes.index");
	}

	public function show($id)
	{
		$subscribe = Subscribe::query()->findOrFail($id);
		if(request()->wantsJson())
		{
			return response()->json($subscribe);
		}
		return view("admin.subscribes.info",compact('subscribe'));
	}
}