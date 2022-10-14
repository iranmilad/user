<?php

namespace App\Http\Controllers;

use App\Http\Requests\Notification\storeNotificationRequest;
use App\Models\Notification;
use App\Traits\Notification\Notification as NotificationTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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

	public function alertNotification(Request $request)
	{
        Log::info($request);
        $a=array (
            'data' =>array (

            ),
        );
        foreach ($request->data as $notification){

        }

        return $this->responseJson("نوتیفیکیشن با موفقیت دریافت شد",null,201);

	}


}
