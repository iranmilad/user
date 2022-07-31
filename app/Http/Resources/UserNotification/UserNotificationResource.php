<?php

namespace App\Http\Resources\UserNotification;

use App\Constants\jDateFormat;
use Illuminate\Http\Resources\Json\JsonResource;

class UserNotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->when($this->id !== null, $this->id),
            "notification_id"=> $this->when($this->notification_id !== null, $this->notification_id),
            "notification"=> $this->when($this->relationLoaded("notification") !== null, $this->notification),    
            "user_id"=> $this->when($this->user_id !== null, $this->user_id),          
            "user"=> $this->when($this->relationLoaded("user") !== null, $this->user),          
            "seen_at"=> $this->when($this->seen_at !== null, $this->seen_at),          
            "created_at" => $this->when($this->created_at !== null, jdate($this->created_at)->format(jDateFormat::S)),
        ];
    }
}