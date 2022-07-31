<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserQuestion;
use App\Http\Resources\UserQuestion\UserAuestionCollection;
use App\Http\Requests\UserQuestion\storeUserAuestionRequest;
use App\Http\Requests\UserQuestion\updateUserAuestionRequest;
use Illuminate\Http\Request;
use App\Traits\Paginate;

class UserAuestionController extends Controller
{
	use Paginate;
	public function index(Request $request)
	{
		if($request->wantsJson())
		{
            $query = UserQuestion::query();
            $userAuestions = $this->paginate($query,["id","user_id","type","title","question","answerd_at","answerd_by","created_at"]);
            return response()->json(new UserAuestionCollection($userAuestions));
		}
		return view("admin.userAuestions.index");
	}

	public function create()
	{
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return view("admin.userAuestions.create");
	}

	public function store(storeUserAuestionRequest $request)
	{
		UserQuestion::query()->create($request->all());
		
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return redirect()->route("userAuestions.index");
	}

	public function edit($id)
	{
		$userAuestion = UserQuestion::query()->findOrFail($id);
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return view("admin.userAuestions.edit",compact('userAuestion'));
	}

	public function update(updateUserAuestionRequest $request,$id)
	{
		$userAuestion = UserQuestion::query()->findOrFail($id);
		$userAuestion->update($request->all());
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return redirect()->route("userAuestions.index");
	}

	public function destroy($id)
	{
		$userAuestion = UserQuestion::query()->findOrFail($id);
		$userAuestion->delete();
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return redirect()->route("userAuestions.index");
	}

	public function show($id)
	{
		$userAuestion = UserQuestion::query()->findOrFail($id);
		if(request()->wantsJson())
		{
			return response()->json($userAuestion);
		}
		return view("admin.userAuestions.info",compact('userAuestion'));
	}
}