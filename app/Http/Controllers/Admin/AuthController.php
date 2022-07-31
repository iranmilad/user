<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $username = $request->input("username");

        $admin = Admin::query()->Where("mobile",$username)->first();

        if (!$admin || !Hash::check($request->input("password"), $admin->password)) { 
           throw ValidationException::withMessages(["error"=>"اطلاعات ورود اشتباه می باشد"]);
        } else if(!$admin->active) {
            throw ValidationException::withMessages(["error"=>"حساب کاربری شما غیرفعال شده است."]);
        }else{
            auth("web")->login($admin);
        }


        return redirect()->route("home");
    }

    public function logout()
    {
        auth("web")->logout();

        return redirect()->route('login');
    }

}
