<?php

namespace App\Http\Resources\User;

use App\Constants\jDateFormat;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            "first_name" => $this->when($this->first_name !== null, $this->first_name),
            "last_name" => $this->when($this->last_name !== null, $this->last_name),
            "mobile" => $this->when($this->mobile !== null, $this->mobile),
            "email" => $this->when($this->email !== null, $this->email),
            "active" => $this->when($this->active !== null, $this->active),
            "special" => $this->when($this->relationLoaded("subscribe") !== null, !!$this->subscribe),
            "created_at" => $this->when($this->created_at !== null, jdate($this->created_at)->format(jDateFormat::S)),
        ];
    }
}