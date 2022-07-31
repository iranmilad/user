<?php

namespace App\Http\Controllers;

use App\Models\Chart;

class ChartController extends Controller
{
	public function index()
	{
		$charts=Chart::query()->paginate(15,["id","title","key","refresh_time","subsribes","feeder_url"]);
		if(request()->wantsJson())
		{
			return response()->json($charts);
		}
		return view("charts.index",compact('charts'));
	}
}