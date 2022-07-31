<?php

namespace App\Http\Resources\MemberList;

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
            "title" => $this->when($this->title !== null, $this->title),
            "description" => $this->when($this->description !== null, $this->description),
            "active" => $this->accessibility,
            "created_at" => $this->when($this->created_at !== null, jdate($this->created_at)->format(jDateFormat::S)),
        ];
    }
}