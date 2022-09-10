<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\changePasswordRequest;
use App\Http\Requests\User\confirmRegisterUserRequest;
use App\Http\Requests\User\editUserRequest;
use App\Models\User;
use App\Http\Requests\User\registerUserRequest;
use App\Traits\verificationCode\VerificationCode;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
	use VerificationCode;

	public function register(registerUserRequest $request){

		$vCode=$this->createVerificationCode($request);

		 if($request->wantsJson()){
			 return $this->responseJson("کد تاید به شماره همراه شما پیامک شده است.",[
				 "gu_id"=>$vCode->gu_id,
				 "code"=>$vCode->code,
				],201);
		 }
	}

	public function confirmRegister(confirmRegisterUserRequest $request){

		$verificationCode=$this->verifyCode($request);

		$data=json_decode($verificationCode->info);

		 User::query()->create([
			 "first_name"=>(isset($data->first_name)) ? $data->first_name : "",
			 "last_name"=>$data->last_name,
			 "mobile"=>$verificationCode->mobile,
			 "password"=>Hash::make($data->password),
		 ]);

		 if($request->wantsJson()){
			 return$this->responseJson("حساب کاربری شما با موفقیت ایجاد شده است.",null,201);
		 }
	}

	public function edit(editUserRequest $request){

		$user=auth()->user();

		$user->update($request->only(['first_name','last_name']));

		return $this->responseJson("اطلاعات شما با موفقیت ویرایش شد.",null,201);
	}

	public function changePassword(changePasswordRequest $request){

		$user=auth()->user();

		if(!Hash::check($request->input('current_password'),$user->password)){
            return  $this->responseJson("رمز عبور فعلی اشتباه می باشد.",null,401,"error");
         }

		$user->password=Hash::make($request->input('password'));
		$user->save();

		return $this->responseJson("رمز عبور شما با موفقیت تغییر یافت.",null,201);
	}
}
