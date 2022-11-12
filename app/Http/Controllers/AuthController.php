<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\SendSmsJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','resendPassword']]);
    }

    public function login()
    {
        $mobile=request("mobile");

        $user=User::query()->where('mobile',$mobile)->first(['id','password','active']);
        if(!$user){
           return  $this->responseJson("کاربری با این شماره ثبت نام نشده است.",null,404,"error");
        }
        if(!$user->active){
            return  $this->responseJson("حساب کاربری شما غیر فعال شده است.",null,403,"error");
         }

        if(!Hash::check(request('password'),$user->password)){
            return  $this->responseJson("اطلاعات ورود اشتباه می باشد.",null,401,"error");
         }

         $token=  auth()->login($user);

        return $this->respondWithToken($token);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function logout()
    {
        auth()->logout();

        return $this->responseJson('با موفقیت خارج شدید.');
    }

    public function resendPassword(Request $request)
    {
        $mobile=$request->input("mobile");
        $user=User::query()->where('mobile',$mobile)->first(['id','password','active']);

        if(!$user){
            return  $this->responseJson("کاربری با این شماره ثبت نام نشده است.",null,404,"error");
         }
         if(!$user->active){
             return  $this->responseJson("حساب کاربری شما غیر فعال شده است.",null,403,"error");
          }

        $password = random_int(100000, 999999);

        SendSmsJob::dispatch($mobile, "رمز عبور جدید شما : $password");

        return $this->responseJson('رمز عبور جدید به شماره همراه شما ارسال شده است.');
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        return $this->responseJson('با موفقیت وارد شدید.',[
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ],200);
    }
}
