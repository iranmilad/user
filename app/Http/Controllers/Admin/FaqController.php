<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use App\Http\Resources\Faq\FaqCollection;
use App\Http\Requests\Faq\storeFaqRequest;
use App\Http\Requests\Faq\updateFaqRequest;
use Illuminate\Http\Request;
use App\Traits\Paginate;

class FaqController extends Controller
{
use Paginate;
	public function index(Request $request)
	{
		if($request->wantsJson())
		{
            $query = Faq::query();
            $faqs = $this->paginate($query,["id","question","answer","created_at"]);
            return response()->json(new FaqCollection($faqs));
		}
		return view("admin.faqs.index");
	}

	public function create()
	{
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return view("admin.faqs.create");
	}

	public function store(storeFaqRequest $request)
	{
		Faq::query()->create($request->all());
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return redirect()->route("faqs.index");
	}

	public function edit($id)
	{
		$faq = Faq::query()->findOrFail($id);
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return view("admin.faqs.edit",compact('faq'));
	}

	public function update(updateFaqRequest $request,$id)
	{
		$faq = Faq::query()->findOrFail($id);
		$faq->update($request->all());
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return redirect()->route("faqs.index");
	}

	public function destroy($id)
	{
		$faq = Faq::query()->findOrFail($id);
		$faq->delete();
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return redirect()->route("faqs.index");
	}

	public function show($id)
	{
		$faq = Faq::query()->findOrFail($id);
		if(request()->wantsJson())
		{
			return response()->json($faq);
		}
		return view("admin.faqs.info",compact('faq'));
	}
}