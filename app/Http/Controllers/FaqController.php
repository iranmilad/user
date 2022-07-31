<?php

namespace App\Http\Controllers;

use App\Models\Faq;

class FaqController extends Controller
{
	public function index()
	{
		$faqs=Faq::query()->get(["id","question","answer"]);
		if(request()->wantsJson())
		{
			return $this->responseJson("",$faqs);;
		}
		return view("faqs.index",compact('faqs'));
	}
}