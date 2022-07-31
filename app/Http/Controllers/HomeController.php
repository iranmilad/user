<?php

namespace App\Http\Controllers;

use App\Http\Resources\Chart\UserChartResource;
use App\Http\Resources\Menu\UserMenuResource;
use App\Http\Resources\User\UserResource;
use App\Models\Chart;
use App\Models\Faq;
use App\Models\Menu;
use stdClass;

class HomeController extends Controller
{
	public function index()
	{
		$menus=UserMenuResource::collection(Menu::query()->get(["id","title","key"]));
		$chartAndTables=UserChartResource::collection(Chart::query()->get(["id","title","key","refresh_time","feeder_url"]));

		$data=new stdClass();
		$data->menus=$menus;
		$data->chartAndtables=$chartAndTables;
		$data->profile=auth()->check() ? new UserResource(auth()->user()) : null;

			// if(request()->wantsJson()){
			return response()->json($data);
		// }
	}
}