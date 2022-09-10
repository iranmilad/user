<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Resources\User\UserCollection;
use App\Http\Requests\User\storeUserRequest;
use App\Http\Requests\User\updateUserRequest;
use Illuminate\Http\Request;
use App\Traits\Paginate;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
	use Paginate;
	public function index(Request $request)
	{
		if($request->wantsJson())
		{
            $query = User::query()->with('subscribe');
            $users = $this->paginate($query,["id","first_name","last_name","mobile","email","active","created_at"]);
            return response()->json(new UserCollection($users));
		}
		return view("admin.users.index");
	}

	public function create()
	{
		return view("admin.users.create");
	}

	public function store(storeUserRequest $request)
	{
		User::query()->create($request->all());

		return redirect()->route("users.index");
	}

	public function edit($id)
	{
		$user = User::query()->findOrFail($id);

		return view("admin.users.edit",compact('user'));
	}

	public function update(updateUserRequest $request,$id)
	{
		$user = User::query()->findOrFail($id);
		$user->update($request->all());

		return redirect()->route("users.index");
	}

	public function destroy($id)
	{
		$user = User::query()->findOrFail($id);
        User::where(['id'=>$id,])->delete();
		#$user->delete();

		return view("admin.users.index");
	}

	public function show($id)
	{
		$user = User::query()->findOrFail($id);

		return view("admin.users.info",compact('user'));
	}

	public function changeActive($id){
		$user = User::query()->findOrFail($id);
		$user->active=!$user->active;
		$user->save();

		if(request()->wantsJson())
		{
			return response()->json($user);
		}
		return redirect()->route("users.index");
	}

	public function search(Request $request){
		$key=$request->input("q");

		$users = User::query()->where(function($query)use($key){
				$query->where('mobile','like','%'.$key.'%')
				->orWhere(DB::raw('concat(first_name," ",last_name)'),'like','%'.$key.'%');
		})->get(['id','first_name','last_name','mobile']);

		if(request()->wantsJson())
		{
			return response()->json($users);
		}
		return redirect()->route("users.index");
	}
}
