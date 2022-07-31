<?php

namespace App\Http\Resources\UserToken;

use App\Constants\jDateFormat;
use Illuminate\Http\Resources\Json\JsonResource;

class UserTokenResource extends JsonResource
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
            "user" => $this->when($this->relationLoaded('user') !== null, $this->user),
            "token" => $this->when($this->token !== null, $this->token),
            "device" => $this->when($this->device !== null, $this->device),
            "created_at" => $this->when($this->created_at !== null, jdate($this->created_at)->format(jDateFormat::S)),
        ];
    }
}