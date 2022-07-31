<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Http\Resources\Menu\MenuCollection;
use App\Http\Requests\Menu\storeMenuRequest;
use App\Http\Requests\Menu\updateMenuRequest;
use App\Models\SubscribeAccessibility;
use Illuminate\Http\Request;
use App\Traits\Paginate;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class MenuController extends Controller
{
use Paginate;
	public function index(Request $request)
	{
		if($request->wantsJson())
		{
            $query = Menu::query()->with('subscribes');
            $menus = $this->paginate($query,["id","title","key","created_at"]);
            return response()->json(new MenuCollection($menus));
		}
		return view("admin.menus.index");
	}

	public function create()
	{
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return view("admin.menus.create");
	}

	public function store(storeMenuRequest $request)
	{
		if(!auth()->user()->supper_admin){
			throw ValidationException::withMessages(["error"=>"مجاز به افزودن نمی باشید"]);
		}

		try{
			DB::beginTransaction();

			$menu=Menu::query()->create($request->all());

			$this->createSubscribe($request,$menu);
	
			DB::commit();

			if(request()->wantsJson())
			{
				return response()->json();
			}
			return redirect()->route("menus.index");
		}catch(\Exception $ex){
			DB::rollBack();
			throw ValidationException::withMessages(["error"=>"خطا در ثبت اطلاعات."]);
		}		
	}

	private function createSubscribe($request , $menu){
		$subscribes=$request->input('subscribes');
	
		if($subscribes && is_array($subscribes)){
			foreach($subscribes as $subscribe){
				SubscribeAccessibility::create([
					"subscribe_id"=>$subscribe["id"],
					"reference_id"=>$menu->id,
					"reference_type"=>2
				]);
			}

		}
	}

	public function edit($id)
	{
		$menu = Menu::query()->findOrFail($id);
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return view("admin.menus.edit",compact('menu'));
	}

	public function update(updateMenuRequest $request,$id)
	{
		if(!auth()->user()->supper_admin){
			throw ValidationException::withMessages(["error"=>"مجاز به ویرایش نمی باشید"]);
		}

		try{
			DB::beginTransaction();

			$menu = Menu::query()->findOrFail($id);
			$menu->update($request->all());

			$menu->subscribes()->delete();

			$this->createSubscribe($request , $menu);

			DB::commit();

			if(request()->wantsJson())
			{
				return response()->json();
			}
			return redirect()->route("menus.index");

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
		$menu = Menu::query()->findOrFail($id);
		$menu->delete();
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return redirect()->route("menus.index");
	}

	public function show($id)
	{
		$menu = Menu::query()->findOrFail($id);
		if(request()->wantsJson())
		{
			return response()->json($menu);
		}
		return view("admin.menus.info",compact('menu'));
	}
	
	public function changeJustSpecialUsers($id){
		$menu = Menu::query()->findOrFail($id);
		$menu->just_special_users=!$menu->just_special_users;
		$menu->save();

		if(request()->wantsJson())
		{
			return response()->json($menu);
		}
		return redirect()->route("menus.index");
	}
}