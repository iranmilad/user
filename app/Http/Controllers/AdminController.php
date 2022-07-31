<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Http\Requests\Admin\storeAdminRequest;
use App\Http\Requests\Admin\updateAdminRequest;

class AdminController extends Controller
{
	public function index()
	{
		$admins=Admin::query()->paginate(15,["id","first_name","last_name","mobile","supper_admin","password","active"]);
		if(request()->wantsJson())
		{
			return response()->json($admins);
		}
		return view("admins.index",compact('admins'));
	}
}