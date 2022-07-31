<?php

namespace App\Http\Controllers\Admin;

use App\Models\MemberList;
use App\Http\Resources\MemberList\MemberListCollection;
use App\Http\Requests\MemberList\storeMemberListRequest;
use App\Http\Requests\MemberList\updateMemberListRequest;
use App\Http\Resources\UserMemberList\UserMemberListCollection;
use App\Models\SubscribeAccessibility;
use Illuminate\Http\Request;
use App\Traits\Paginate;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class MemberListController extends Controller
{
    use Paginate;

	public function index(Request $request)
	{
		if($request->wantsJson())
		{
            $query = MemberList::query()->with("subscribes");
            $memberLists = $this->paginate($query,["id","title","description","created_at"]);
            return response()->json(new MemberListCollection($memberLists));
		}
		return view("admin.memberLists.index");
	}

	public function users(Request $request,$id)
	{
		if($request->wantsJson())
		{
            $query = MemberList::query()->findOrFail($id);
			$query=$query->users()->with('user:id,first_name,last_name');
            $memberLists = $this->paginate($query,["id","user_id","member_list_id","created_at"]);
            return response()->json(new UserMemberListCollection($memberLists));
		}
		return view("admin.memberLists.index");
	}

	public function create()
	{
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return view("admin.memberLists.create");
	}

	public function store(storeMemberListRequest $request)
	{
		try{
			DB::beginTransaction();

			$memberList=MemberList::query()->create($request->all());

			$this->createSubscribe($request,$memberList);

			DB::commit();
			if(request()->wantsJson())
			{
				return response()->json();
			}
			return redirect()->route("memberLists.index");
		}catch(\Exception $ex){
			DB::rollBack();
			throw ValidationException::withMessages(["error"=>"خطا در ثبت اطلاعات."]);
		}		
	}

	private function createSubscribe($request , $memberList){
		$subscribes=$request->input('subscribes');
	
		if($subscribes && is_array($subscribes)){
			foreach($subscribes as $subscribe){
				SubscribeAccessibility::create([
					"subscribe_id"=>$subscribe["id"],
					"reference_id"=>$memberList->id,
					"reference_type"=>3
				]);
			}

		}
	}

	public function edit($id)
	{
		$memberList = MemberList::query()->findOrFail($id);
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return view("admin.memberLists.edit",compact('memberList'));
	}

	public function update(updateMemberListRequest $request,$id)
	{
		try{
			DB::beginTransaction();

			$memberList = MemberList::query()->findOrFail($id);
			$memberList->update($request->all());

			$memberList->subscribes()->delete();

			$this->createSubscribe($request,$memberList);

			DB::commit();

			if(request()->wantsJson())
			{
				return response()->json();
			}
			return redirect()->route("memberLists.index");
		}catch(\Exception $ex){
			DB::rollBack();
			throw ValidationException::withMessages(["error"=>"خطا در ثبت اطلاعات."]);
		}		
	}

	public function destroy($id)
	{
		$memberList = MemberList::query()->findOrFail($id);
		$memberList->users()->delete();
		$memberList->delete();
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return redirect()->route("memberLists.index");
	}

	public function destroyUser($id,$user_id)
	{
		$memberList = MemberList::query()->findOrFail($id);
		$memberList->users()->where('id',$user_id)->delete();
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return redirect()->route("memberLists.index");
	}

	public function show($id)
	{
		$memberList = MemberList::query()->findOrFail($id);
		if(request()->wantsJson())
		{
			return response()->json($memberList);
		}
		return view("admin.memberLists.info",compact('memberList'));
	}

	public function changeSpecialUsers($id){
		$memberList = MemberList::query()->findOrFail($id);
		$memberList->special_users=!$memberList->special_users;
		$memberList->save();

		if(request()->wantsJson())
		{
			return response()->json($memberList);
		}
		return redirect()->route("memberLists.index");
	}

	public function createUser(Request $request, $id)
	{
		$memberList = MemberList::query()->findOrFail($id);
		$users=$request->input('user_id');
		$lists=$memberList->users;

		foreach($users as $user_id){
			if($lists->where('user_id',$user_id)->count()==0)
				$memberList->users()->create(['user_id'=>$user_id]);
		}
	
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return redirect()->route("memberLists.show",$id);
	}
}