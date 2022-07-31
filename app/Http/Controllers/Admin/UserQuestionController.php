<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserQuestion;
use App\Http\Resources\UserQuestion\UserQuestionCollection;
use App\Http\Requests\UserQuestion\storeUserQuestionRequest;
use App\Http\Requests\UserQuestion\updateUserQuestionRequest;
use App\Models\Notification;
use App\Models\UserNotification;
use Illuminate\Http\Request;
use App\Traits\Paginate;

class UserQuestionController extends Controller
{
use Paginate;
	public function index(Request $request)
	{
		if($request->wantsJson())
		{
            $query = UserQuestion::query()->with(["user:id,first_name,last_name","responder:id,first_name,last_name"]);
            $userQuestions = $this->paginate($query,["id","user_id","type","title","question","answer","answerd_at","answerd_by","created_at"]);
            return response()->json(new UserQuestionCollection($userQuestions));
		}
		return view("admin.userQuestions.index");
	}

	public function create()
	{
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return view("admin.userQuestions.create");
	}

	public function store(storeUserQuestionRequest $request)
	{
		UserQuestion::query()->create($request->all());
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return redirect()->route("userQuestions.index");
	}

	public function edit($id)
	{
		$userQuestion = UserQuestion::query()->findOrFail($id);
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return view("admin.userQuestions.edit",compact('userQuestion'));
	}

	public function update(updateUserQuestionRequest $request,$id)
	{
		$userQuestion = UserQuestion::query()->findOrFail($id);
		$userQuestion->update($request->all());
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return redirect()->route("userQuestions.index");
	}

	public function destroy($id)
	{
		$userQuestion = UserQuestion::query()->findOrFail($id);
		$userQuestion->delete();
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return redirect()->route("userQuestions.index");
	}

	public function show($id)
	{
		$userQuestion = UserQuestion::query()->findOrFail($id);
		if(request()->wantsJson())
		{
			return response()->json($userQuestion);
		}
		return view("admin.userQuestions.info",compact('userQuestion'));
	}

	public function answer(Request $request)
	{
		$id=$request->input('id');
		$answer=$request->input('answer');

		$userQuestion = UserQuestion::query()->findOrFail($id);

		$userQuestion->answer=$answer;
		$userQuestion->answerd_by=auth()->id();
		$userQuestion->answerd_at=now();
		$userQuestion->save();

		$notification=Notification::create([
			"title"=>"پاسخ پرسش",
			"text"=>$answer,
			"type"=>2,
		]);

		UserNotification::create([
			"user_id"=>$userQuestion->user_id,
			"notification_id"=>$notification->id,
		]);

		if(request()->wantsJson())
		{
			return response()->json($userQuestion);
		}
		return redirect()->route("userQuestions.index");
	}
}