<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserMemberList\UserMemberListResource;
use App\Models\MemberList;
use App\Models\UserMemberList;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserMemberListController extends Controller
{

	public function index(){
		$memberLists=auth()->user()->memberLists()->with('memberList:id,title,description')->get();

		if(request()->wantsJson())
		{
			return $this->responseJson(null,UserMemberListResource::collection($memberLists),201);
		}
	}

	public function create(Request $request)
	{
		$memberListId=$request->input("member_list_id");
		$memberList=MemberList::query()->findOrFail($memberListId);

		if(!auth()->user()->has_subscribe && $memberList->special_users){
			throw ValidationException::withMessages(["error"=>"فقط کاربران ویژه مجاز به انجام عملیات می باشند."]);
		}

		$userMemberList=UserMemberList::query()->where([['user_id',auth()->id()],['member_list_id',$memberListId]])->first();
		if($userMemberList){
			throw ValidationException::withMessages(["error"=>"قبلا عضو ممبر لیست شده اید."]);
		}

        UserMemberList::query()->create([
			"member_list_id"=>$memberListId,
			"user_id"=>auth()->id(),
		]);

		if(request()->wantsJson())
		{
			return $this->responseJson("با موفقیت عضو ممبر لیست شدید.",null,201);
		}
	}

	public function delete(Request $request)
	{
		$memberListId=$request->input("member_list_id");
		$memberList=MemberList::query()->findOrFail($memberListId);

		if(!auth()->user()->has_subscribe && $memberList->special_users){
			throw ValidationException::withMessages(["error"=>"فقط کاربران ویژه مجاز به انجام عملیات می باشند."]);
		}

		$userMemberList=UserMemberList::query()->where([['user_id',auth()->id()],['member_list_id',$memberListId]])->first();
		if($userMemberList){
            UserMemberList::query()->delete([
                "member_list_id"=>$memberListId,
                "user_id"=>auth()->id(),
            ]);
        }
        else{
            throw ValidationException::withMessages(["error"=>"شما در این ممبر لیست عضو نیستید."]);
        }



		if(request()->wantsJson())
		{
			return $this->responseJson("با موفقیت عضو ممبر لیست خارج شدید.",null,201);
		}
	}

}
