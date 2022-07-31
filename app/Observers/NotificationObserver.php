<?php

namespace App\Observers;

use App\Constants\NotificationTypes;
use App\Jobs\SendNotificationJob;
use App\Models\Notification;
use App\Models\UserToken;
use Illuminate\Support\Facades\Log;

class NotificationObserver
{
    public $afterCommit = true;
    /**
     * Handle the Notification "created" event.
     *
     * @param  \App\Models\Notification  $notification
     * @return void
     */
    public function created(Notification $notification)
    {
        if($notification->type==NotificationTypes::PUBLIC){
            $tokens=UserToken::query()->pluck('token');
        }else{
             $userIds=$notification->users()->pluck('user_id');

             $tokens=UserToken::query()->whereIn('user_id',$userIds)->pluck('token');
        }
       
        SendNotificationJob::dispatch($tokens,$notification->title,$notification->text);
    }

    /**
     * Handle the Notification "updated" event.
     *
     * @param  \App\Models\Notification  $notification
     * @return void
     */
    public function updated(Notification $notification)
    {
        //
    }

    /**
     * Handle the Notification "deleted" event.
     *
     * @param  \App\Models\Notification  $notification
     * @return void
     */
    public function deleted(Notification $notification)
    {
        //
    }

    /**
     * Handle the Notification "restored" event.
     *
     * @param  \App\Models\Notification  $notification
     * @return void
     */
    public function restored(Notification $notification)
    {
        //
    }

    /**
     * Handle the Notification "force deleted" event.
     *
     * @param  \App\Models\Notification  $notification
     * @return void
     */
    public function forceDeleted(Notification $notification)
    {
        //
    }
}
