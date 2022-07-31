<?php

namespace App\Http\Resources\UserMemberList;

use App\Constants\jDateFormat;
use Illuminate\Http\Resources\Json\JsonResource;

class UserMemberListResource extends JsonResource
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
            "user_id" => $this->when($this->user_id !== null, $this->user_id),
            "user" => $this->when($this->relationLoaded('user'), $this->user),
            "member_list_id" => $this->when($this->member_list_id !== null, $this->member_list_id),
            "title" => $this->when($this->relationLoaded('memberList'), $this->memberList->title??''),
            "description" => $this->when($this->relationLoaded('memberList'), $this->memberList->description??''),
            "created_at" => $this->when($this->created_at !== null, jdate($this->created_at)->format(jDateFormat::S)),
        ];
    }
}