<?php

namespace App\Http\Controllers;

use App\Http\Requests\Notification\storeNotificationRequest;
use App\Traits\Notification\Notification as NotificationTrait;

class NotificationController extends Controller
{
	use NotificationTrait;

	public function push(storeNotificationRequest $request)
	{

		$this->createNotification($request);
		
		if(request()->wantsJson())
		{
			return $this->responseJson("نوتیفیکیشن با موفقیت ارسال شد.",null,201);
		}
		return view("notifications.index",compact('notifications'));
	}
}