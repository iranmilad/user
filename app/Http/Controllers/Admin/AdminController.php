<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Http\Resources\Admin\AdminCollection;
use App\Http\Requests\Admin\storeAdminRequest;
use App\Http\Requests\Admin\updateAdminRequest;
use Illuminate\Http\Request;
use App\Traits\Paginate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Artisan;
class AdminController extends Controller
{
	use Paginate;
	public function index(Request $request)
	{

		if($request->wantsJson())
		{
            $query = Admin::query();
            $admins = $this->paginate($query,["id","first_name","last_name","mobile","supper_admin","active","created_at"]);
            return response()->json(new AdminCollection($admins));
		}
		return view("admin.admins.index");
	}

	public function create()
	{
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return view("admin.admins.create");
	}

	public function store(storeAdminRequest $request)
	{
		$request->request->add([
			"password"=>Hash::make($request->input('password')),
			"supper_admin"=>$request->input('supper_admin')=="on",
			"active"=>$request->input('active')=="on",
		]);
		Admin::query()->create($request->all());
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return redirect()->route("admins.index");
	}

	public function edit($id)
	{
		$admin = Admin::query()->findOrFail($id);
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return view("admin.admins.edit",compact('admin'));
	}

	public function update(updateAdminRequest $request,$id)
	{
		if(!auth()->user()->supper_admin){
			throw ValidationException::withMessages(["error"=>"مجاز به ویرایش نمی باشید"]);
		}
		$request->request->add([
			"supper_admin"=>$request->input('supper_admin')=="on",
			"active"=>$request->input('active')=="on",
		]);
		$admin = Admin::query()->findOrFail($id);
		$admin->update($request->all());
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return redirect()->route("admins.index");
	}

	public function destroy($id)
	{
		$admin = Admin::query()->findOrFail($id);
		if($admin->id==auth()->id() || !auth()->user()->supper_admin){
			throw ValidationException::withMessages(["error"=>"مجاز به حذف نمی باشید"]);
		}

		$admin->delete();
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return redirect()->route("admins.index");
	}

	public function show($id)
	{
		$admin = Admin::query()->findOrFail($id);
		if(request()->wantsJson())
		{
			return response()->json($admin);
		}
		return view("admin.admins.info",compact('admin'));
	}

	public function profile()
    {
        $admin = auth()->user();
        return view("admin.admins.profile", compact('admin'));
    }


    public function changePassword()
    {
        return view("admin.admins.changePass");
    }

    public function updateProfile(Request $request)
    {
        Admin::query()->update($request->only(["first_name", "last_name"]));
        return redirect()->route("admin.profile")->with("success", "تغییرات با موفقیت ذخیره شد.");
    }


    public function updatePassword(Request $request)
    {
        $oldPass=$request->input('old_password');
        $newPass=$request->input('new_password');
        $rePass=$request->input('re_password');

        $admin = Admin::query()->findOrFail(auth()->id());
        if ($newPass != $rePass){
            throw ValidationException::withMessages(['old_password'=>"رمز عبور جدید با تکرار رمز عبور یکسان نیست."]);
        }
        if (!Hash::check($oldPass,$admin->password)){
            throw ValidationException::withMessages(['old_password'=>"رمز عبور فعلی اشتباه است."]);
        }
        $admin->password = Hash::make($newPass);
        $admin->save();
        auth()->logout();

        return redirect()->route('home');
    }

	public function changeActive($id){
		$admin = Admin::query()->findOrFail($id);
		$admin->active=!$admin->active;
		$admin->save();

		if(request()->wantsJson())
		{
			return response()->json($admin);
		}
		return redirect()->route("admins.index");
	}
    public function clear()
    {
        Artisan::call('cache:clear');
        sleep(4);
        Artisan::call('config:clear');
        sleep(4);

        Artisan::call('route:clear');
        sleep(4);

        Artisan::call('view:clear');
        sleep(4);

        return "Cache is cleared";
    }

    public function migrate(){
        Artisan::call('queue:batches-table');
        Artisan::call('migrate');
        return "Migrate queue table";

    }

}
