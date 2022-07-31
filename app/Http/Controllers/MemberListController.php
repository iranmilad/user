<?php

namespace App\Http\Controllers;

use App\Http\Resources\MemberList\UserMemberListResource;
use App\Models\MemberList;

class MemberListController extends Controller
{
	public function index()
	{
		$memberLists=MemberList::query()->get(["id","title","description"]);

		if(request()->wantsJson())
		{
			return $this->responseJson(UserMemberListResource::collection($memberLists));
		}
		return view("memberLists.index",compact('memberLists'));
	}
}