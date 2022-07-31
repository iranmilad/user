<?php

namespace App\Http\Resources\UserNotification;

use App\Constants\jDateFormat;
use Illuminate\Http\Resources\Json\JsonResource;

class UserNotificationListResource extends JsonResource
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
            "title"=>$this->title,
            "text"=>$this->text,
            "type"=>$this->type==1?"public":"private",
            "seen_at" =>$this->users? $this->users->where("user_id",auth()->id()??null)->first()->seen_at??null : null,
            "created_at" => $this->when($this->created_at !== null, jdate($this->created_at)->format(jDateFormat::S)),
        ];
    }
}