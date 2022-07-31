<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Http\Requests\Menu\storeMenuRequest;
use App\Http\Requests\Menu\updateMenuRequest;

class MenuController extends Controller
{
	public function index()
	{
		$menus=Menu::query()->paginate(15,["id","title","key"]);
		if(request()->wantsJson())
		{
			return response()->json($menus);
		}
		return view("menus.index",compact('menus'));
	}
}