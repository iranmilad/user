<?php

namespace App\Traits\Notification;

use App\Constants\NotificationTypes;
use App\Http\Requests\Notification\storeNotificationRequest;
use App\Models\MemberList;
use App\Models\Notification as ModelsNotification;
use App\Models\User;
use App\Models\UserNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait Notification {

    private function createNotification(storeNotificationRequest $request){
        $type=$request->input('type');

		try{
		DB::beginTransaction();
		$notification=ModelsNotification::query()->create($request->all());

		if($type!=NotificationTypes::PUBLIC){
			if($type==NotificationTypes::PRIVATE)
				$userIds=$request->input("user_id");
			else if($type==NotificationTypes::SPESIALS)
					$userIds=User::query()->whereHas('subscribe')->pluck('id');
			else if($type==NotificationTypes::NON_SPESIALS)
				$userIds=User::query()->whereDoesntHave('subscribe')->pluck('id');
			else if($type==NotificationTypes::MEMBER_LIST)
				$userIds=MemberList::query()->findOrFail($request->input('member_list_id'))->users()->pluck('user_id');

			foreach($userIds as $userId){
				UserNotification::query()->create([
                     "user_id"=>$userId,
                     "notification_id"=>$notification->id,
				]);
			}

			DB::commit();
		}
		}catch(\Exception $ex){
            Log::warning($ex);
			DB::rollBack();
		}

    }
}
