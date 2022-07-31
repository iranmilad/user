<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserNotification\UserNotificationListResource;
use App\Models\Notification;

class UserNotificationController extends Controller
{
	public function index()
	{
		$user=auth()->user();

		$notifications=Notification::query()->where(function($query) use($user){
			$query->where('type',1)
			->orWhereHas('users',function($query) use($user){
				$query->where('user_id',$user->id);
			});
		})->whereDate('created_at','>',"$user->created_at")
			->limit(30)
			->orderByDesc("id")
			->get(["id","title","text","type","created_at"]);
		
		$userNotifications=UserNotificationListResource::collection($notifications);

		if(request()->wantsJson())
		{
			return $this->responseJson('',$userNotifications);
		}
	}

	public function seen($id){
         $notification=Notification::query()->findOrFail($id);

		 $this->authorize($notification);

		 $userId=auth()->id() ?? null;

		 $userNotification=$notification->users()->where('user_id',$userId)->first();

		 if($userNotification){
			 $userNotification->seen_at=now();
			 $userNotification->save();
		 }else{
			$notification->users()->create([
				"user_id"=>$userId,
				"seen_at"=>now(),
			]);
		 }

		 return $this->responseJson("تغییرات با موفقیت ثبت شد.",);
	}
}