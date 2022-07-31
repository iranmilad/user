<?php

namespace App\Http\Controllers;

use App\Models\UserQuestion;
use App\Http\Requests\UserQuestion\storeUserQuestionRequest;

class UserQuestionController extends Controller
{
	public function store(storeUserQuestionRequest $request)
	{
		request()->request->add(["user_id"=>auth()->id()]);

		UserQuestion::query()->create($request->all());

		if(request()->wantsJson())
		{
			return $this->responseJson("پرسش شما با موفقیت ثبت گردید. در اولین فرست پاسخ داده خواهد شد.",null,201);;
		}
		return redirect()->route("userQuestions.index");
	}

}