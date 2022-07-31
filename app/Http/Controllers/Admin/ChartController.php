<?php

namespace App\Http\Controllers\Admin;

use App\Models\Chart;
use App\Http\Resources\Chart\ChartCollection;
use App\Http\Requests\Chart\storeChartRequest;
use App\Http\Requests\Chart\updateChartRequest;
use App\Models\SubscribeAccessibility;
use Illuminate\Http\Request;
use App\Traits\Paginate;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ChartController extends Controller
{
	use Paginate;
	public function index(Request $request)
	{
		if($request->wantsJson())
		{
            $query = Chart::query()->with("subscribes");
            $charts = $this->paginate($query,["id","title","key","refresh_time","feeder_url","created_at"]);
            return response()->json(new ChartCollection($charts));
		}
		return view("admin.charts.index");
	}

	public function create()
	{
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return view("admin.charts.create");
	}

	public function store(storeChartRequest $request)
	{
		if(!auth()->user()->supper_admin){
			throw ValidationException::withMessages(["error"=>"مجاز به افزودن نمی باشید"]);
		}

		try{
			DB::beginTransaction();

			$chart=Chart::query()->create($request->all());

			$this->createSubscribe($request , $chart);

			DB::commit();

			if(request()->wantsJson())
			{
				return response()->json();
			}
			return redirect()->route("charts.index");
		}catch(\Exception $ex){
			DB::rollBack();
			throw ValidationException::withMessages(["error"=>"خطا در ثبت اطلاعات."]);
		}

	}

	private function createSubscribe($request , $chart){
		$subscribes=$request->input('subscribes');

		if($subscribes && is_array($subscribes)){
			foreach($subscribes as $subscribe){
				SubscribeAccessibility::create([
					"subscribe_id"=>$subscribe["id"],
					"reference_id"=>$chart->id,
					"reference_type"=>1,
					"refresh_time"=>$subscribe["refresh_time"],
				]);
			}

		}
	}

	public function edit($id)
	{
		$chart = Chart::query()->findOrFail($id);
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return view("admin.charts.edit",compact('chart'));
	}

	public function update(updateChartRequest $request,$id)
	{
		if(!auth()->user()->supper_admin){
			throw ValidationException::withMessages(["error"=>"مجاز به ویرایش نمی باشید"]);
		}

		try{
			DB::beginTransaction();

			$chart = Chart::query()->findOrFail($id);
			$chart->update($request->all());

			$chart->subscribes()->delete();

			$this->createSubscribe($request,$chart);

			DB::commit();

			if(request()->wantsJson())
			{
				return response()->json();
			}
			return redirect()->route("charts.index");


		}catch(\Exception $ex){
			DB::rollBack();
			throw ValidationException::withMessages(["error"=>"خطا در ثبت اطلاعات."]);
		}


	}

	public function destroy($id)
	{
		if(!auth()->user()->supper_admin){
			throw ValidationException::withMessages(["error"=>"مجاز به حذف نمی باشید"]);
		}
		$chart = Chart::query()->findOrFail($id);
		$chart->delete();
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return redirect()->route("charts.index");
	}

	public function show($id)
	{
		$chart = Chart::query()->findOrFail($id);
		if(request()->wantsJson())
		{
			return response()->json($chart);
		}
		return view("admin.charts.info",compact('chart'));
	}

	public function changeJustSpecialUsers($id){
		$chart = Chart::query()->findOrFail($id);
		$chart->just_special_users=!$chart->just_special_users;
		$chart->save();

		if(request()->wantsJson())
		{
			return response()->json($chart);
		}
		return redirect()->route("charts.index");
	}
}
